<?php

namespace App\Http\Livewire;

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
        return view('livewire.maha-siswa-list-quisioner');
    }
}
