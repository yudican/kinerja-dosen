<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\DataDosen;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;
use App\Models\DataMahasiswa;
use App\Models\QustionAnswer;
use App\Models\QustionAnswerDetail;

class MahaSiswaListQuisionerTable  extends LivewireDatatable
{
  protected $listeners = ['refreshTable'];
  public $hideable = 'select';
  public $hide = [];


  public function builder()
  {
    return QustionAnswerDetail::query()->where('user_id', $this->params['user_id'])->where('data_jadwal_id', $this->params['quis_id'])->groupBy('user_id');
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
