<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
      /**
     * Display the chat interface with user messages.
     */
    public function index()
    {
        // $messages = ChatMessage::where('user_id', Auth::id())->latest()->get();
        return view('components.chat.index'
        
        // , compact('messages')
    
    );
    }

    /**
     * Handle sending a new chat message.
     */
    // public function send(Request $request)
    // {
    //     $validated = $request->validate([
    //         'message' => 'required|string',
    //     ]);

    //     // Placeholder for AI response (e.g., call xAI Grok API)
    //     $response = 'AI response coming soon!'; // Replace with actual API call

    //     ChatMessage::create([
    //         'user_id' => Auth::id(),
    //         'message' => $validated['message'],
    //         'response' => $response,
    //     ]);

    //     return redirect()->route('chat.index')->with('success', 'Message sent!');
    // }
}
