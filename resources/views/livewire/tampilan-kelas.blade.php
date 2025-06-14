<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tampilan Data Per Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Filter Data Berdasarkan Kelas</h2>
                <div class="mt-4">
                    <label for="pilih_kelas" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Pilih
                        Kelas</label>
                    <select id="pilih_kelas" wire:model.live="selectedKelasId"
                        class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">-- Tampilkan Semua Kelas --</option>
                        @foreach ($semuaKelas as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @forelse ($kelasList as $kelas)
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-xl font-bold border-b pb-2 mb-4 text-gray-900 dark:text-gray-100">
                        Kelas: {{ $kelas->nama_kelas }}
                    </h3>

                    <h4 class="text-md font-bold text-gray-900 dark:text-gray-100">
                        Daftar Guru ({{ $kelas->guru->count() }} orang)
                    </h4>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        @forelse($kelas->guru as $guru)
                            <li class="text-gray-700 dark:text-gray-200">{{ $guru->nama }} (NIP: {{ $guru->nip }})
                            </li>
                        @empty
                            <li class="text-gray-500 dark:text-gray-400">Belum ada guru di kelas ini.</li>
                        @endforelse
                    </ul>

                    <h4 class="text-md font-bold text-gray-900 dark:text-gray-100 mt-4">
                        Daftar Siswa ({{ $kelas->siswa->count() }} orang)
                    </h4>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        @forelse($kelas->siswa as $siswa)
                            <li class="text-gray-700 dark:text-gray-200">{{ $siswa->nama }} (NIS: {{ $siswa->nis }})
                            </li>
                        @empty
                            <li class="text-gray-500 dark:text-gray-400">Belum ada siswa di kelas ini.</li>
                        @endforelse
                    </ul>
                </div>
            @empty
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <p class="text-gray-700 dark:text-gray-300">
                        Tidak ada data kelas untuk ditampilkan. Silakan buat data kelas terlebih dahulu.
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
