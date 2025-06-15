<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Guru;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Listall extends Component
{
    public $kelasList;
    public $siswaList;
    public $guruList;

    public function mount()
    {
        $this->kelasList = Kelas::orderBy('nama_kelas')->get();

        $this->siswaList = Siswa::with('kelas')->orderBy('nama')->get();

        $this->guruList = Guru::with('kelas')->orderBy('nama')->get();
    }

    public function render()
    {
        return view('livewire.tampilan-all-kelas', [
            'kelasList' => $this->kelasList,
            'siswaList' => $this->siswaList,
            'guruList'  => $this->guruList,
        ]);
    }
}
