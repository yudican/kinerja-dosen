<?php

namespace App\Http\Livewire;

use App\Models\DataJadwal;
use App\Models\QustionAnswerDetail;
use Livewire\Component;
use Phpml\Clustering\KMeans;
use Phpml\Clustering\KMeans\Space;

class PerhitunganKinerja extends Component
{
    public $semester_id;
    public function render()
    {
        $semester_id = $this->semester_id;
        $lists = DataJadwal::whereHas('qustionAnswerDetails')->get();

        if ($semester_id) {
            $lists = DataJadwal::where('data_semester_id', $semester_id)->whereHas('qustionAnswerDetails')->get();
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

        return view('livewire.perhitungan-kinerja', [
            'items' =>  $lists,
            'perhitungan' => $final_data
        ]);
    }
}
