<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kelas;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class KelasList extends Component
{
    use WithPagination;

    public string $nama_kelas = '';
    public ?int $kelas_id = null;
    public int $iteration = 0;
    public string $originalNamaKelas = '';
    public bool $isUpdate = false;

    protected function rules(): array
    {
        return [
            'nama_kelas' => 'required|string|min:3|max:255|unique:kelas,nama_kelas,' . $this->kelas_id . ',id',
        ];
    }


    public function render()
    {
        $kelasList = Kelas::latest()->paginate(5);

        return view('livewire.kelas-list', [
            'kelasList' => $kelasList
        ]);
    }


    public function store()
    {
        $this->validate();

        Kelas::create(['nama_kelas' => $this->nama_kelas]);

        session()->flash('message', 'Kelas berhasil ditambahkan.');
        $this->resetInput();
    }


    public function edit(Kelas $kelas)
    {
        $this->kelas_id = $kelas->id;
        $this->originalNamaKelas = $kelas->nama_kelas;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->isUpdate = true;
    }

    public function update()
    {
        $this->validate();

        if ($this->kelas_id) {
            $kelas = Kelas::find($this->kelas_id);
            $kelas->update(['nama_kelas' => $this->nama_kelas]);

            session()->flash('message', 'Kelas berhasil diupdate.');
            return redirect()->route('list.kelas');
        }
    }


    public function delete(int $id)
    {
        Kelas::find($id)->delete();
        session()->flash('message', 'Kelas berhasil dihapus.');
    }


    public function cancelUpdate()
    {
        $this->resetInput();
    }


    private function resetInput()
    {
        $this->reset(['nama_kelas', 'kelas_id', 'isUpdate']);
        $this->iteration++;
    }
}
