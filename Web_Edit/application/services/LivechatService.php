<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LivechatService extends CI_Service
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('basic');
        $this->load->library('session'); // For accessing session data
    }

    /**
     * Returns team members list.
     * @return array
     */
    public function getTeamMemberList(): array
    {
        // Ensure team_member addon is active before querying
        if (!method_exists($this->CI, 'addon_exist') || !$this->CI->addon_exist("team_member")) {
            return [];
        }

        $user_id = $this->session->userdata('user_id'); // Get current user's ID
        $team_data = $this->basic->get_data("team_members", ["where" => ['user_id' => $user_id]], ["id", "name"], "", "", NULL, "name ASC");
        $team_list = ['' => $this->lang->line("Select Agent")]; // Localized string
        foreach ($team_data as $k => $v) {
            $team_list[$v['id']] = $v['name'];
        }
        return $team_list;
    }

    /**
     * Inserts a system message into the live chat conversation.
     */
    public function insertSystemMessageIntoConversation(int $subscriber_id, int $page_table_id, string $agent_name, string $message_content, ?string $social_media = null, ?int $user_id = null)
    {
        $insert_data = [
            'subscriber_id' => $subscriber_id,
            'page_table_id' => $page_table_id,
            'sender' => "system",
            'agent_name' => $agent_name,
            'message_content' => $message_content,
            'conversation_time' => date('Y-m-d H:i:s')
        ];
        if (!empty($social_media)) $insert_data['platform'] = $social_media;
        if (!empty($user_id)) $insert_data['user_id'] = $user_id;
        $this->basic->insert_data("livechat_messages", $insert_data);
    }

    /**
     * Assigns a conversation to a team member.
     */
    public function assignConversationToTeamMember(int $subscriber_id, ?int $team_member_id = null, int $page_table_id, ?int $team_assign_role_id = null, string $social_media_type)
    {
        $assigned_team_member_id = $team_member_id;
        $assigned_team_member_name = "";

        if (isset($team_assign_role_id) && $team_assign_role_id > 0) {
            $team_members_by_role = $this->basic->get_data("team_members", ["where" => ['team_role_id' => $team_assign_role_id]], ['id', 'name']);
            if (!empty($team_members_by_role)) {
                $random_index = array_rand($team_members_by_role);
                $assigned_team_member_id = $team_members_by_role[$random_index]['id'];
                $assigned_team_member_name = $team_members_by_role[$random_index]['name'];
            }
        } else if ($team_member_id > 0) {
            $member_info = $this->basic->get_data("team_members", ["where" => ['id' => $team_member_id]], ['name']);
            $assigned_team_member_name = $member_info[0]['name'] ?? '';
        }

        if ($assigned_team_member_id > 0) {
            $this->basic->update_data('messenger_bot_subscriber', ["subscribe_id" => $subscriber_id, 'page_table_id' => $page_table_id], ["assigned_used_id" => $assigned_team_member_id]);

            $message_content = $this->lang->line('Conversation was assigned to') . " {$assigned_team_member_name}";
            $this->insertSystemMessageIntoConversation($subscriber_id, $page_table_id, "Bot", $message_content, $social_media_type);

            $this->agentAssignNotifications($social_media_type, $assigned_team_member_id, $subscriber_id);
        }
    }

    /**
     * Sends notifications to the assigned agent.
     */
    public function agentAssignNotifications(string $social_media = 'fb', int $assigned_used_id, int $subscriber_id): bool
    {
        $subscriber_data = $this->basic->get_data("messenger_bot_subscriber", ["where" => ["subscribe_id" => $subscriber_id]], ["first_name", "last_name", "full_name"]);
        $subscriber_name = $subscriber_data[0]["full_name"] ?? ($subscriber_data[0]["first_name"] ?? "" . " " . $subscriber_data[0]["last_name"] ?? "");

        $social_media_name = ($social_media == 'ig') ? 'Instagram' : 'Messenger';
        $title =  $social_media_name . " " . $this->lang->line('Livechat Assigned');
        $color_class = ($social_media == 'ig') ? 'warning' : 'primary';
        $icon_class = ($social_media == 'ig') ? 'fab fa-instagram' : 'fab fa-facebook';
        $message_content = $this->lang->line('You have been assigned to ') . " <b>" . $subscriber_name . "</b> " . $social_media_name . " " . $this->lang->line('Livechat Agent.');

        $insert_data = [
            'title' => $title,
            'description' => $message_content,
            'created_at' => date("Y-m-d H:i:s"),
            'user_id' => -1, // -1 for system generated notification
            'team_member_id' => $assigned_used_id,
            'color_class' => $color_class,
            'icon' => $icon_class,
            'status' => 'published'
        ];

        if ($assigned_used_id > 0) {
            $this->basic->insert_data("announcement", $insert_data);

            // Pusher notification logic (ensure Pusher library and config are set up)
            $pusher_data = [$this->session->userdata('user_id'), $assigned_used_id, $title, $message_content, date("Y-m-d H:i:s"), $subscriber_name, $social_media];
            $data_json = json_encode($pusher_data);

            if (mb_strlen($data_json, '8bit') <= 10000) { // Check size limit for Pusher
                $this->load->config('pusher');
                if (!empty($this->config->item("pusher_app_key"))) {
                    $this->load->library('ci_pusher'); // Assuming this is your Pusher library
                    $pusher = $this->ci_pusher->get_pusher();
                    $pusher->trigger('livechat_assigned_agent_channel', 'livechat_assigned_agent_event', $pusher_data);
                }
            }
        }
        return true;
    }

    /**
     * Get where clause for announcements.
     * @param int $user_id
     * @param int $is_manager
     * @param int $real_user_id
     * @return string
     */
    public function getAnnouncementWhereClause(int $user_id, int $is_manager, int $real_user_id): string
    {
        if ($is_manager == 1) {
            return "(team_member_id=" . $real_user_id . " AND is_seen='0')";
        } else {
            return "(user_id=" . $user_id . " AND is_seen='0') OR (user_id=0 AND NOT FIND_IN_SET('" . $user_id . "', seen_by))";
        }
    }
}
