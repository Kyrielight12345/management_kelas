<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ $isUpdate ? 'Update Data Siswa' : 'Tambah Siswa Baru' }}
                </h2>

                @if (session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-3"
                        role="alert">
                        <span class="block sm:inline">{{ session('message') }}</span>
                    </div>
                @endif
                @if ($isUpdate)
                    <div class="space-y-2">
                        <label class="block font-medium text-sm text-gray-500 dark:text-gray-400">Data Lama (yang
                            akan diedit):</label>
                        <input type="text" disabled value="Nama: {{ $originalNama }}"
                            class="border-gray-300 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed">
                        <input type="text" disabled value="NIS: {{ $originalNis }}"
                            class="border-gray-300 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed">
                        <input type="text" disabled value="Kelas: {{ $originalKelasNama }}"
                            class="border-gray-300 bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed">
                    </div>
                @endif
                <form wire:submit.prevent="{{ $isUpdate ? '' : 'store' }}" class="mt-6 space-y-6">
                    <div>
                        <label for="nama" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama
                            Siswa</label>
                        <input id="nama" type="text"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                            wire:model.defer="nama" wire:key="nama-{{ $iteration }}"
                            placeholder="Masukan Nama Lengkap Siswa">
                        @error('nama')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="nis" class="block font-medium text-sm text-gray-700 dark:text-gray-300">NIS
                            (Nomor Induk Siswa)</label>
                        <input id="nis" type="text"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                            wire:model.defer="nis" wire:key="nis-{{ $iteration }}" placeholder="Masukan NIS">
                        @error('nis')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="kelas_id"
                            class="block font-medium text-sm text-gray-700 dark:text-gray-300">Kelas</label>
                        <select id="kelas_id"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                            wire:model.defer="kelas_id" wire:key="kelas-{{ $iteration }}">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($kelasList as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        @if ($isUpdate)
                            <button wire:click="update" type="button"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                wire:loading.attr="disabled">
                                <div wire:loading wire:target="update" class="btn-spinner mr-2"></div>
                                Update
                            </button>
                            <button wire:click="cancelUpdate" type="button"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Batal
                            </button>
                        @else
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                wire:loading.attr="disabled">
                                <div wire:loading wire:target="store" class="btn-spinner mr-2"></div>
                                Simpan
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Daftar Siswa</h2>
                <div class="overflow-x-auto mt-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama Siswa</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    NIS</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Kelas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($siswaList as $index => $item)
                                <tr wire:key="siswa-row-{{ $item->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $siswaList->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $item->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $item->nis }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $item->kelas->nama_kelas ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button wire:click="edit({{ $item->id }})"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900">Edit</button>
                                        <button wire:click="delete({{ $item->id }})"
                                            wire:confirm="Anda yakin ingin menghapus data siswa ini?"
                                            class="text-red-600 dark:text-red-400 hover:text-red-900 ml-4">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                        Data siswa tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $siswaList->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
