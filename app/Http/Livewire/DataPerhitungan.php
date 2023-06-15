<?php

namespace App\Http\Livewire;

use Livewire\Component;


class DataPerhitungan extends Component
{
  public $route_name;
  public function mount()
  {
    $this->route_name = request()->route()->getName();
  }

  public function render()
  {
    return view('livewire.data-perhitungan');
  }
}
