<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeminiController extends Controller
{
    public function index()
    {
        // استرجاع الرسائل من السيشن
        $messages = session('chat_history', []);

        return view('components.chat.index', compact('messages'));
    }

    public function chat(Request $request)
    {
        $prompt = $request->input('prompt');
        // استدعاء Gemini API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => config('services.gemini.key'),
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent", [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        $data = $response->json();
        $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';

        // إذا كان الطلب AJAX أعد JSON بدل الرجوع للصفحة
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'text' => $text,
            ]);
        }

        // نخزن الرسائل في السيشن (user + bot)
        $messages = session('chat_history', []);
        $messages[] = ['role' => 'user', 'text' => $prompt];
        $messages[] = ['role' => 'bot', 'text' => $text];
        session(['chat_history' => $messages]);

        return back();
    }
}