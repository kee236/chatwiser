<?php

class Meps
{
    public $success_url;
    public $failure_url;
    public $cancel_url;
    public $paymaya_mode;
    public $button_lang;

    public $redirect_url;


    function __construct()
    {

        $this->CI =& get_instance();

        $query = $this->CI->db->get('payment_config');
        $config_data = $query->result_array();

        // $this->paymaya_public_key = isset($config_data[0]['paymaya_public_key']) ? $config_data[0]['paymaya_public_key'] : "";
        // $this->paymaya_secret_key = isset($config_data[0]['paymaya_secret_key']) ? $config_data[0]['paymaya_secret_key'] : "";
        // $this->paymaya_mode = isset($config_data[0]['paymaya_mode']) ? $config_data[0]['paymaya_mode'] : "live";
        // $this->base_64 = base64_encode($this->paymaya_public_key . ":" . $this->paymaya_secret_key);
        // $this->secret_key_base64 = base64_encode($this->paymaya_secret_key);

        // if ($this->paymaya_mode == 'sandbox')
        //   $this->paymaya_api_url = "https://pg-sandbox.paymaya.com/checkout/v1/checkouts";
        // else
        //   $this->paymaya_api_url = "https://pg.paymaya.com/checkout/v1/checkouts";
    }

    function set_button()
    {

        $button_lang = !empty($this->button_lang) ? $this->button_lang : $this->CI->lang->line("Pay with Meps");

        $button = "
      <a href='" . $this->redirect_url . "' class='list-group-item list-group-item-action flex-column align-items-start'>
      <div class='d-flex w-100 align-items-center'>
      <small class='text-muted'><img class='rounded' width='60' height='60' src='" . base_url('assets/img/payment/meps.png') . "'></small>
      <h6 class='mb-1'>" . $button_lang . "</h6>
      </div>
      </a>";

        return $button;

    }


    public function checkout_url()
    {

        echo 'alaa';

    }


    public function get_checkoutid($checkout_id)
    {

        $ch = curl_init();

        $data = [
            "profile_id" => 147094, // Replace with your actual profile_id
            "tran_ref" => $checkout_id, // Replace with your actual transaction reference
        ];

        curl_setopt($ch, CURLOPT_URL, "https://secure-jordan.paytabs.com/payment/query");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "authorization: SRJ9TJRKBL-JJLD2T29GN-MZLHRJ9GMK", // Replace with your real key
            "content-type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        curl_close($ch);
        return json_decode($response, true);


    }

}

?>