<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class MahaSiswaListQuisionerAnswer extends Component
{
    public function render()
    {
        return view('livewire.maha-siswa-list-quisioner-answer', [
            'question_lists' => Question::all(),
        ]);
    }
}
