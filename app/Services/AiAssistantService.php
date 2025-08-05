<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiAssistantService
{
    public function processText(string $text): array
    {
        $url = 'http://192.168.0.129:8000/process_audio/';

        $response = Http::post($url, [
            'text' => $text,
        ]);

        // If response failed, handle it
        if (!$response->successful()) {
            return [
                'error' => true,
                'message' => 'Failed to connect to AI service.',
            ];
        }

        return $response->json();
    }
}
