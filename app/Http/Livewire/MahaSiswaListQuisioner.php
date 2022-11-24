<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MahaSiswaListQuisioner extends Component
{
    public $quis_id;
    public $user_id;
    public function mount($id, $user_id)
    {
        $this->quis_id = $id;
        $this->user_id = $user_id;
    }
    public function render()
    {
        return view('livewire.maha-siswa-list-quisioner');
    }
}
