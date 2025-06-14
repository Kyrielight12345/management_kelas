<?php

namespace App\Livewire;

use App\Models\Siswa;
use App\Models\Kelas;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class SiswaList extends Component
{
    use WithPagination;

    public string $nama = '';
    public string $nis = '';
    public ?int $kelas_id = null;

    public ?int $siswa_id = null;
    public bool $isUpdate = false;
    public int $iteration = 0;

    public string $originalNama = '';
    public string $originalNis = '';
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
            'nis' => 'required|string|min:4|max:20|unique:siswas,nis,' . $this->siswa_id,
            'kelas_id' => 'required|integer|exists:kelas,id',
        ];
    }

    public function render()
    {
        $siswaList = Siswa::with('kelas')->latest()->paginate(5);

        return view('livewire.siswa-list', [
            'siswaList' => $siswaList
        ]);
    }

    public function store()
    {
        $this->validate();

        Siswa::create([
            'nama' => $this->nama,
            'nis' => $this->nis,
            'kelas_id' => $this->kelas_id,
        ]);

        session()->flash('message', 'Data siswa berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit(Siswa $siswa)
    {
        $this->siswa_id = $siswa->id;
        $this->nama = $siswa->nama;
        $this->nis = $siswa->nis;
        $this->kelas_id = $siswa->kelas_id;

        $this->originalNama = $siswa->nama;
        $this->originalNis = $siswa->nis;
        $this->originalKelasNama = $siswa->kelas ? $siswa->kelas->nama_kelas : 'Tidak Diketahui';

        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->siswa_id) {
            $siswa = Siswa::find($this->siswa_id);
            $siswa->update([
                'nama' => $this->nama,
                'nis' => $this->nis,
                'kelas_id' => $this->kelas_id,
            ]);

            session()->flash('message', 'Data siswa berhasil diupdate.');
            return redirect()->route('list.siswa');
        }
    }

    public function delete(int $id)
    {
        $siswa = Siswa::find($id);
        if ($siswa) {
            $siswa->delete();
            session()->flash('message', 'Data siswa berhasil dihapus.');
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
            'nis',
            'kelas_id',
            'siswa_id',
            'isUpdate',
            'originalNama',
            'originalNis',
            'originalKelasNama'
        ]);
        $this->iteration++;
    }
}
