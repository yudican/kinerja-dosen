<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MahaSiswaListQuisioner extends Component
{
    public $quis_id;
    public function mount($id)
    {
        $this->quis_id = $id;
    }
    public function render()
    {
        return view('livewire.maha-siswa-list-quisioner');
    }
}
