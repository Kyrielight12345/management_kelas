<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kelas;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Listsiswa extends Component
{
    public $semuaKelas;

    public $selectedKelasId = null;


    public function mount()
    {
        $this->semuaKelas = Kelas::orderBy('nama_kelas')->get();
    }


    public function render()
    {
        $query = Kelas::with('siswa');

        if (!empty($this->selectedKelasId)) {
            $query->where('id', $this->selectedKelasId);
        }

        $kelasList = $query->orderBy('nama_kelas')->get();

        return view('livewire.siswa-per-kelas', [
            'kelasList' => $kelasList,
        ]);
    }
}
