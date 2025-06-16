<?php

namespace App\Livewire;

use App\Models\OrangTua;
use App\Models\Siswa;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Ortu extends Component
{
    use WithPagination;

    public string $nama = '';
    public string $nip = '';
    public ?int $siswa_id = null;

    public ?int $ortu_id = null;
    public bool $isUpdate = false;
    public int $iteration = 0;

    public string $originalNama = '';
    public string $originalNip = '';
    public string $originalKelasNama = '';

    public $kelasList = [];


    public function mount()
    {
        $this->kelasList = Siswa::orderBy('nama')->get();
    }


    protected function rules(): array
    {
        return [
            'nama' => 'required|string|min:3|max:255',
        ];
    }


    public function render()
    {
        $ortuList = OrangTua::with('siswa')->latest()->paginate(5);

        return view('livewire.orang-tua', [
            'guruList' => $ortuList
        ]);
    }


    public function store()
    {
        $this->validate();

        OrangTua::create([
            'nama' => $this->nama,
            'siswa_id' => $this->siswa_id,
        ]);

        session()->flash('message', 'Data Ortu berhasil ditambahkan.');
    }

    public function edit(OrangTua $ortu)
    {
        $this->ortu_id = $ortu->id;
        $this->nama = $ortu->nama;
        $this->siswa_id = $ortu->siswa_id;

        $this->originalNama = $ortu->nama;
        $this->originalKelasNama = $ortu->siswa ? $ortu->siswa->nama : 'Tidak diketahui';

        $this->isUpdate = true;
    }


    public function update()
    {
        $this->validate();

        if ($this->ortu_id) {
            $ortu = OrangTua::find($this->ortu_id);
            $ortu->update([
                'nama' => $this->nama,
                'siswa_id' => $this->siswa_id,
            ]);

            session()->flash('message', 'Data guru berhasil diupdate.');
            return redirect()->route('tampilan.ortu');
        }
    }

    public function delete(int $id)
    {
        $ortu = OrangTua::find($id);
        if ($ortu) {
            $ortu->delete();
            session()->flash('message', 'Data guru berhasil dihapus.');
        }
    }


    public function cancelUpdate()
    {
        return redirect()->route('tampilan.ortu');
    }


    private function resetInput()
    {
        $this->reset([
            'nama',
        ]);
        $this->iteration++;
    }
}
