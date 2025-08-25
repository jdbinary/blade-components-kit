<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CreateSession extends Component
{
    public $sessions = [];

    public function mount()
    {
        $this->loadSessions();
    }

    public function loadSessions()
    {
        $this->sessions = DB::table('sessions')
            ->where('user_id', Auth::id())
            ->orderBy('last_activity', 'desc')
            ->get()
            ->map(function ($session) {
                return [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'user_agent' => $session->user_agent,
                    'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'is_current' => $session->id === Session::getId(),
                ];
            })
            ->toArray();
    }

    public function logoutOtherDevices()
    {
        DB::table('sessions')->where('user_id', Auth::id())->where('id', '!=', Session::getId())->delete();

        $this->loadSessions();
    }

    public function logoutSession($sessionId)
    {
        DB::table('sessions')->where('user_id', Auth::id())->where('id', $sessionId)->delete();

        $this->loadSessions();
    }
    public function render()
    {
        return view('livewire.create-session');
    }
}
