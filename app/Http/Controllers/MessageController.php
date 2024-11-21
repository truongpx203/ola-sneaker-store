<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function showChat(){
        return view('client.chat');
    }

    public function messageReceived(Request $request){
        $rules = [
            'message' => 'required',
        ];

        $request->validate($rules);

        broadcast(new MessageEvent($request->user(), $request->message));

        return response()->json('Message broadcast');
    }

    public function greetReceived(Request $request, User $receiver){
        broadcast(new GreetingSent($receiver, "{$request->user()->name} đã chào bạn"));
        broadcast(new GreetingSent($request->user(), "Bạn đã chào {$receiver->name}"));

        return "Lời chào từ {$request->user()->name} đến {$receiver->name}";
    }

}
