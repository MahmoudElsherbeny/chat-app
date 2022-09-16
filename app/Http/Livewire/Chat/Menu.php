<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use Livewire\Component;

class Menu extends Component
{
    protected $listeners = [
        'mark_read' => 'render',
        'refresh_list' => 'render'
    ]; 

    public function render()
    {
        $chats = Chat::UserChats()->orderBy('updated_at', 'DESC')->get();

        return view('livewire.chat.menu')->with('chats', $chats);
    }
}
