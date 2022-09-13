<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use Livewire\Component;

class Menu extends Component
{
    protected $listeners = ['mark_read' => 'render'];

    public function render()
    {
        $chats = Chat::UserChats()->get();

        return view('livewire.chat.menu')->with('chats', $chats);
    }
}
