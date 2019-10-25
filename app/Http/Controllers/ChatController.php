<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function fetchMessages()
    {
        $data = Message::with('user')->get();
        return response()->json($data);
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'user_id' => $user->id,
            'message' => $request->message
        ]);
        broadcast(new MessageSent($user, $message))->toOthers();

        $data = [
            'status' => 'Message sent',
            'data' => $request->message
        ];

        return response()->json($data);
    }
}
