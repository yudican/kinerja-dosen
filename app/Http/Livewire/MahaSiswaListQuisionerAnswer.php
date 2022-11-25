<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class MahaSiswaListQuisionerAnswer extends Component
{
    public $user_id;
    public $question_id;

    public function mount($id, $user_id)
    {
        $this->user_id = $user_id;
        $this->question_id = $id;
    }

    public function render()
    {
        return view('livewire.maha-siswa-list-quisioner-answer', [
            'question_lists' => Question::all(),
        ]);
    }
}
