<?php

namespace App\Http\Livewire;

use App\Models\DataJadwal;
use App\Models\Question;
use App\Models\QustionAnswerDetail;
use KMeans\Space;
use Livewire\Component;


class DetailPerhitungan extends Component
{
  public $perhitungan;
  public $chartData;
  public $items;
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
      $space->addPoint($coordinates);
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

    $values[1] = 0;
    $values[2] = 0;
    $values[3] = 0;
    $values[4] = 0;
    $values[5] = 0;
    foreach ($lists as $key => $item) {
      foreach ($item->qustionAnswerDetails as $key => $attribute) {
        if (isset($values[$attribute->optionQuestion->bobot_jawaban])) {
          $values[$attribute->optionQuestion->bobot_jawaban] += 1;
        }
      }
    }



    $charts = [
      'labels' => ['sangat tidak baik', 'tidak baik', 'cukup baik', 'baik', 'sangat baik'],
      'values' => [
        $values[1],
        $values[2],
        $values[3],
        $values[4],
        $values[5],
      ]
    ];
    dd($charts);
    $this->perhitungan = $final_data;
    $this->chartData = $charts;
    $this->items =  $lists;
  }


  public function render()
  {
    return view('livewire.detail-perhitungan');
  }
}
