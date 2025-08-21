<?php
// application/libraries/AiApi.php

use OpenAI\Client;

class AiApi
{
    private $CI;
    private $client;
    
    public function __construct(string $apiKey)
    {
        $this->CI = &get_instance();
        // สร้าง client object จาก API key
        $this->client = OpenAI::client($apiKey);
    }
    
    public function getCompletion(string $prompt, string $model = 'gpt-3.5-turbo', int $maxTokens = 1500)
    {
        try {
            // Check if it is a chat completion model
            if (strpos($model, 'gpt-') === 0 || strpos($model, 'text-') !== 0) {
                $response = $this->client->chat()->create([
                    'model' => $model,
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => $maxTokens,
                ]);
                $content = $response->choices[0]->message->content ?? null;
            } else {
                // For legacy text completion models
                $response = $this->client->completions()->create([
                    'model' => $model,
                    'prompt' => $prompt,
                    'max_tokens' => $maxTokens,
                ]);
                $content = $response->choices[0]->text ?? null;
            }
            return ['error' => false, 'content' => $content];
        } catch (\Exception $e) {
            // Log the error for debugging
            log_message('error', 'AI API Error: ' . $e->getMessage());
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
}
