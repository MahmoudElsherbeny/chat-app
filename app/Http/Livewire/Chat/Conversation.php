<?php

namespace App\Http\Livewire\Chat;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Chat;
use Exception;

class Conversation extends Component
{
    public $chat, $chat_with, $friend_relation_block;
    public $message;

    protected $listeners = ['mark_read' => 'render'];

    protected $rules = [
        'message' => 'required',
    ];

    public function render()
    {
        return view('livewire.chat.conversation');
    }

    public function send($user_id) {
        try {
            DB::beginTransaction();
                if(!$this->chat) {
                    $this->chat = Chat::create([
                        'sender_id' => Auth::id(),
                        'receiver_id' => $user_id,
                    ]);
                }

                $this->chat->conversations()->create([
                    'sender_id' => Auth::id(),
                    'receiver_id' => $user_id,
                    'message' => $this->message,
                    'is_read' => 0,
                ]);

                $this->reset(['message']);
                $this->emit('mark_read');

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Error: '.$e->getMessage());
        }
    }
}
