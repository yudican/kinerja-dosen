<?php

namespace App\Http\Livewire\Table;

use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;
use App\Models\QustionAnswerDetail;

class MahaSiswaListQuisionerTable  extends LivewireDatatable
{
  protected $listeners = ['refreshTable'];
  public $params;

  public function builder()
  {
    dd($this->params);
    return QustionAnswerDetail::query()->where('qustion_answer_details.user_id', $this->params['user_id'])->where('qustion_answer_details.data_jadwal_id', $this->params['quis_id'])->groupBy('qustion_answer_details.user_id');
  }

  public function columns()
  {
    return [
      Column::name('user.mahasiswa.kode_mahasiswa')->label('Nim')->searchable(),
      Column::name('user.name')->label('Nama Mahasiswa')->searchable(),

      Column::callback(['option_question_id'], function ($option_question_id) {
        return '<a href="' . route('quisioner.detail.answer', ['option_question_id' => $option_question_id]) . '" class="btn btn-primary btn-sm">Detail</a>';
      })->label(__('Aksi')),
    ];
  }
}
