<?php

namespace App\Http\Livewire;

use App\Models\DataJadwal;
use App\Models\Question;
use App\Models\QustionAnswerDetail;
use KMeans\Space;
use Livewire\Component;


class DetailPerhitungan extends Component
{
  public $data;
  public $chartData;
  public $semester_id;

  public function mount($data_dosen_id)
  {
    $semester_id = $this->semester_id;
    $lists = DataJadwal::where('data_dosen_id', $data_dosen_id)->whereHas('qustionAnswerDetails')->get();

    if ($semester_id) {
      $lists = DataJadwal::where('data_dosen_id', $data_dosen_id)->where('data_semester_id', $semester_id)->whereHas('qustionAnswerDetails')->get();
    }


    $data_cluster = [];
    $dataset = [];

    foreach ($lists as $key => $list) {
      $dataset[] = $list->qustionAnswerDetails()->get()->pluck('optionQuestion.bobot_jawaban')->toArray();
      // foreach ($list->qustionAnswerDetails as $keys => $attribute) {
      //     $attribute->optionQuestion->bobot_jawaban;
      // }
    }
    // dd($dataset);
    $space = new Space(count($dataset[0]));
    // $kmeans = new KMeans(3, KMeans::INIT_RANDOM);
    // add points to space
    foreach ($dataset as $i => $coordinates) {
      if (count($coordinates) == 28) {
        $space->addPoint($coordinates);
      }
    }

    // cluster these 50 points in 3 clusters
    $clusters = $space->solve(4);
    // display the cluster centers and attached points
    foreach ($clusters as $num => $cluster) {
      $coordinates = $cluster->getCoordinates();
      $data_cluster[] = $coordinates;
    }
    $final_data = [];
    foreach ($dataset as $key => $datas) {
      $cls = [];
      foreach ($datas as $keys => $value) {
        foreach ($data_cluster as $index => $value_cluster) {
          $final_value = $value - $value_cluster[$key];
          $pangkat_dua =  $final_value *  $final_value;
          $cls[$key][$keys][] = $pangkat_dua;
        }
      }

      $final_data[$key]['atribut'] = $datas;
      foreach ($cls[$key] as $cskey => $clsval) {
        $final_data[$key]['cluster'][] = sqrt(array_sum($clsval));
        $final_data[$key]['jarak'] = min($final_data[$key]['cluster']);
      }
    }

    $questions = Question::whereHas('optionQuestions', function ($query) use ($data_dosen_id) {
      return $query->whereHas('questionAnswer', function ($query) use ($data_dosen_id) {
        return $query->whereHas('dataJadwal', function ($query) use ($data_dosen_id) {
          return $query->whereHas('dosen', function ($query) use ($data_dosen_id) {
            return $query->where('data_dosen_id', $data_dosen_id);
          });
        });
      });
    })->get();
    $data = [];
    $charts = [];
    foreach ($questions as $key => $question) {
      $data[$question->id][1] = 0;
      $data[$question->id][2] = 0;
      $data[$question->id][3] = 0;
      $data[$question->id][4] = 0;
      $data[$question->id][5] = 0;
      $question_answers = QustionAnswerDetail::whereHas('dataJadwal', function ($query) use ($data_dosen_id) {
        return $query->whereHas('dosen', function ($query) use ($data_dosen_id) {
          return $query->where('data_dosen_id', $data_dosen_id);
        });
      })->whereHas('optionQuestion', function ($query) use ($question) {
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
    dd($this->data);
    $this->data = $final_data;
    $this->chartData = $charts;
  }


  public function render()
  {
    return view('livewire.detail-perhitungan');
  }
}
