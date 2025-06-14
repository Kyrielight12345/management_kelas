<?php

namespace App\Livewire;

use App\Models\Guru;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class GuruList extends Component
{
    use WithPagination;

    public string $nama = '';
    public string $nip = '';
    public ?int $kelas_id = null;

    public ?int $guru_id = null;
    public bool $isUpdate = false;
    public int $iteration = 0;

    public string $originalNama = '';
    public string $originalNip = '';
    public string $originalKelasNama = '';

    public $kelasList = [];


    public function mount()
    {
        $this->kelasList = Kelas::orderBy('nama_kelas')->get();
    }


    protected function rules(): array
    {
        return [
            'nama' => 'required|string|min:3|max:255',
            'nip' => 'required|string|min:5|max:20|unique:gurus,nip,' . $this->guru_id,
            'kelas_id' => 'required|integer|exists:kelas,id',
        ];
    }


    public function render()
    {
        $guruList = Guru::with('kelas')->latest()->paginate(5);

        return view('livewire.guru-list', [
            'guruList' => $guruList
        ]);
    }


    public function store()
    {
        $this->validate();

        Guru::create([
            'nama' => $this->nama,
            'nip' => $this->nip,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Data guru berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit(Guru $guru)
    {
        $this->guru_id = $guru->id;
        $this->nama = $guru->nama;
        $this->nip = $guru->nip;
        $this->kelas_id = $guru->kelas_id;

        $this->originalNama = $guru->nama;
        $this->originalNip = $guru->nip;
        $this->originalKelasNama = $guru->kelas ? $guru->kelas->nama_kelas : 'Tidak diketahui';

        $this->isUpdate = true;
    }


    public function update()
    {
        $this->validate();

        if ($this->guru_id) {
            $guru = Guru::find($this->guru_id);
            $guru->update([
                'nama' => $this->nama,
                'nip' => $this->nip,
                'kelas_id' => $this->kelas_id,
            ]);

            session()->flash('message', 'Data guru berhasil diupdate.');
            return redirect()->route('list.guru');
        }
    }

    public function delete(int $id)
    {
        $guru = Guru::find($id);
        if ($guru) {
            $guru->delete();
            session()->flash('message', 'Data guru berhasil dihapus.');
        }
    }


    public function cancelUpdate()
    {
        $this->resetInput();
    }


    private function resetInput()
    {
        $this->reset([
            'nama',
            'nip',
            'kelas_id',
            'guru_id',
            'isUpdate',
            'originalNama',
            'originalNip',
            'originalKelasNama'
        ]);
        $this->iteration++;
    }
}
