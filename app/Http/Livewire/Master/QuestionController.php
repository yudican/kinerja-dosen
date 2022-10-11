<?php

namespace App\Http\Livewire\Master;

use App\Models\OptionQuestion;
use App\Models\Question;
use Livewire\Component;


class QuestionController extends Component
{

    public $tbl_questions_id;
    public $pertanyaan;
    public $jawaban_nama;
    public $bobot_jawaban;
    public $kunci_jawaban;
    public $route_name;
    public $questions;

    public $form_active = false;
    public $form = true;
    public $update_mode = false;
    public $modal = false;

    public $inputs = [0, 1, 2, 3, 4];
    public $i = 5;

    protected $listeners = ['getDataQuestionById', 'getQuestionId'];

    public function mount()
    {
        $this->route_name = request()->route()->getName();
    }

    public function render()
    {
        return view('livewire.master.tbl-questions', [
            'question_lists' => Question::all(),
        ]);
    }

    public function store()
    {
        $this->_validate();
        $data = ['pertanyaan'  => $this->pertanyaan];

        $question = Question::create($data);

        foreach ($this->jawaban_nama as $key => $value) {
            $question->optionQuestions()->create([
                'nama_jawaban' => $value,
                'bobot_jawaban' => $this->bobot_jawaban[$key]
            ]);
        }

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Disimpan']);
    }

    public function update()
    {
        $this->_validate();

        $data = ['pertanyaan'  => $this->pertanyaan];
        $row = Question::find($this->tbl_questions_id);

        foreach ($this->questions as $key => $value) {
            $option = OptionQuestion::find($value);

            if ($option) {
                $option->update([
                    'nama_jawaban' => $this->jawaban_nama[$key],
                    'bobot_jawaban' => $this->bobot_jawaban[$key]
                ]);
            }
        }

        $row->update($data);

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Diupdate']);
    }

    public function delete()
    {
        Question::find($this->tbl_questions_id)->delete();

        $this->_reset();
        return $this->emit('showAlert', ['msg' => 'Data Berhasil Dihapus']);
    }

    public function _validate()
    {
        $rule = [
            'pertanyaan'  => 'required'
        ];

        foreach ($this->inputs as $key => $value) {
            $rule['jawaban_nama.' . $key] = 'required';
            $rule['bobot_jawaban.' . $key] = 'required|numeric';
        }

        return $this->validate($rule);
    }

    public function getDataQuestionById($tbl_questions_id)
    {
        $this->_reset();
        $tbl_questions = Question::find($tbl_questions_id);
        $this->tbl_questions_id = $tbl_questions->id;
        $this->pertanyaan = $tbl_questions->pertanyaan;
        $this->jawaban_nama = $tbl_questions->optionQuestions()->pluck('nama_jawaban')->toArray();
        $this->bobot_jawaban = $tbl_questions->optionQuestions()->pluck('bobot_jawaban')->toArray();
        $this->questions = $tbl_questions->optionQuestions()->pluck('id')->toArray();
        if ($this->form) {
            $this->form_active = true;
            $this->emit('loadForm');
        }
        if ($this->modal) {
            $this->emit('showModal');
        }
        $this->update_mode = true;
    }

    public function getQuestionId($tbl_questions_id)
    {
        $tbl_questions = Question::find($tbl_questions_id);
        $this->tbl_questions_id = $tbl_questions->id;
    }

    public function toggleForm($form)
    {
        $this->_reset();
        $this->form_active = $form;
        $this->emit('loadForm');
    }

    public function showModal()
    {
        $this->_reset();
        $this->emit('showModal');
    }

    public function _reset()
    {
        $this->emit('closeModal');
        $this->emit('refreshTable');
        $this->tbl_questions_id = null;
        $this->pertanyaan = null;
        $this->form = true;
        $this->form_active = false;
        $this->update_mode = false;
        $this->modal = false;
        $this->jawaban_nama = [];
        $this->bobot_jawaban = [];
        $this->kunci_jawaban = [];
        $this->questions = [];
        $this->inputs = [0, 1, 2, 3, 4];
        $this->i = 5;
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }
}
