<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function rewrite(Request $request)
    {
        $request->validate([
            'text' => 'required|string|min:5|max:5000',
        ]);

        $text = $request->input('text');
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['error' => 'API Key missing.'], 500);
        }

        // 1. Define the Model
        // earlier 'gemini-2.0-flash' failed with quota limits. 
        // 'gemini-1.5-flash' is the safest free option right now.
        $model = 'gemini-2.5-flash-lite'; 

        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

        // 2. Prepare the Prompt
        $systemInstruction = "You are an expert Resume Writer. Rewrite the following text to be professional, using strong action verbs and bullet points. Return ONLY the rewritten text.";
        
        try {
            // 3. Send Request (Matching your cURL structure)
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $apiKey // sending key in header is safer
            ])->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $systemInstruction . "\n\nOriginal Text:\n" . $text]
                        ]
                    ]
                ]
            ]);

            if ($response->failed()) {
                throw new \Exception('Gemini API Error: ' . $response->body());
            }

            $data = $response->json();
            $rewrittenText = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;

            if (!$rewrittenText) {
                return response()->json(['error' => 'AI returned empty response.'], 500);
            }

            return response()->json(['content' => trim($rewrittenText)]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}