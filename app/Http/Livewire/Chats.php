<?php

namespace App\Http\Livewire;

use App\Models\TicketComplaint;
use App\Models\TicketFeedback;
use Livewire\Component;

class Chats extends Component
{

    public $complaint_code;
    public $feedback_desc;

    public final function mount(string $complaint_code)
    {
        $this->complaint_code = $complaint_code;
    }

    public function render()
    {
        return view('livewire.chats', [
            'feedbacks' => TicketFeedback::with('user')->where('complaint_code', $this->complaint_code)->latest()->get(),
            'complaint' => TicketComplaint::where('complaint_code', $this->complaint_code)->first(),
        ]);
    }

    public function send()
    {
        $this->validate(['feedback_desc' => 'required']);
        TicketFeedback::create([
            'user_id' => auth()->user()['id'],
            'complaint_code' => $this->complaint_code,
            'feedback_desc' => $this->feedback_desc,
        ]);

        $this->emit('send');
        $this->feedback_desc = '';
    }
}
