<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kelas;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class RekapList extends Component
{
    public $semuaKelas;

    public $selectedKelasId = null;


    public function mount()
    {
        $this->semuaKelas = Kelas::orderBy('nama_kelas')->get();
    }

    public function render()
    {
        if (!empty($this->selectedKelasId)) {
            $kelasList = Kelas::with(['guru', 'siswa'])
                ->where('id', $this->selectedKelasId)
                ->get();
        } else {

            $kelasList = Kelas::with(['guru', 'siswa'])
                ->orderBy('nama_kelas')
                ->get();
        }

        return view('livewire.tampilan-kelas', [
            'kelasList' => $kelasList,
        ]);
    }
}
