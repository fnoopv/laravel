<?php

namespace App\Http\Controllers;

use App\Http\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    protected $message;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->message = $messageRepository;
    }

    public function store()
    {
        $message = $this->message->create([
            'to_user_id' => request('user'),
            'from_user_id' => Auth::guard('api')->user()->id,
            'body' => request('body')
        ]);
        if ($message)
        {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
