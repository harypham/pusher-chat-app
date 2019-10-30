<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;
use Auth;
use App\Events\GroupNewMessages;

class ConversationController extends Controller
{
    public function index(){
        $data = [
            'conversations' => Conversation::all()->where('group_id','2'),
        ];
        return response()->json($data);
    }
    public function store(Request $request)
    {

        $conversation = Conversation::create([
            'message' => $request->newmessage,
            'group_id' => $request->group_id,
            'user_id' => Auth::user()->id,
        ]);

        broadcast(new GroupNewMessages($conversation))->toOthers();
        $data = [
            'message'=> 'ok',
        ];
        return response()->json($data);
    }
}
