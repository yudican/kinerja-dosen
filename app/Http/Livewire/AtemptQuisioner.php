<?php

namespace App\Http\Livewire;

use App\Models\DataJadwal;
use App\Models\Question;
use App\Models\QustionAnswerDetail;
use Livewire\Component;

class AtemptQuisioner extends Component
{
    public $jadwal_id;
    public $pilih_jawaban = [];

    public function mount($id = null)
    {
        if (!$id) return abort(404);

        $this->jadwal_id = $id;
    }

    public function render()
    {
        $questions = Question::all();
        return view('livewire.atempt-quisioner', ['questions' => $questions]);
    }

    public function store()
    {
        $data = [];
        foreach ($this->pilih_jawaban as $key => $value) {
            $data[] = [
                'user_id' => auth()->user()->id,
                'data_jadwal_id' => $this->jadwal_id,
                'option_question_id' => $value,
            ];
        }
        QustionAnswerDetail::insert($data);
        $this->_reset();
        $this->emit('showAlert', ['msg' => 'Jawaban Berhasil Disimpan', 'redirect' => true, 'path' => '/quisioner/list']);
    }

    public function setUserAnswer($question_id, $option_id)
    {
        $this->pilih_jawaban[$question_id] = $option_id;
    }

    public function _reset()
    {
        $this->jadwal_id = null;
        $this->pilih_jawaban = [];
    }
}
