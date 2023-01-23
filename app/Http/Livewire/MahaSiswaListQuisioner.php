<?php

namespace App\Http\Livewire;

use App\Models\Question;
use App\Models\QustionAnswerDetail;
use Livewire\Component;

class MahaSiswaListQuisioner extends Component
{
    public $quis_id;
    public function mount($quis_id)
    {
        $this->quis_id = $quis_id;
    }
    public function render()
    {
        $questions = Question::all();
        $data = [];
        $charts = [];
        foreach ($questions as $key => $question) {
            $data[$question->id][1] = 0;
            $data[$question->id][2] = 0;
            $data[$question->id][3] = 0;
            $data[$question->id][4] = 0;
            $data[$question->id][5] = 0;
            $question_answers = QustionAnswerDetail::whereHas('optionQuestion', function ($query) use ($question) {
                $query->where('question_id', $question->id);
            })->groupBy('user_id')->get();
            foreach ($question_answers as $key => $answer) {
                if (isset($data[$question->id][$answer->optionQuestion->bobot_jawaban])) {
                    $data[$question->id][$answer->optionQuestion->bobot_jawaban] += 1;
                }
            }
        }

        foreach ($questions as $key => $question) {
            $charts[] = [
                'id' => $question->id,
                'labels' => ['sangat tidak baik', 'tidak baik', 'cukup baik', 'baik', 'sangat baik'],
                'values' => [
                    $data[$question->id][1],
                    $data[$question->id][2],
                    $data[$question->id][3],
                    $data[$question->id][4],
                    $data[$question->id][5],
                ]
            ];
        }

        return view('livewire.maha-siswa-list-quisioner', [
            'question_lists' => Question::all(),
            'chartData' => $charts
        ]);
    }
}
