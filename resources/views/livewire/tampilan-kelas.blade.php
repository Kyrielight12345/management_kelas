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
                    <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-gray-100">
                        Kelas: {{ $kelas->nama_kelas }}
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-1/12">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        ID (NIP/NIS)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td colspan="3" class="px-6 py-2 bg-gray-100 dark:bg-gray-700">
                                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                            Daftar Guru ({{ $kelas->guru->count() }} orang)
                                        </h4>
                                    </td>
                                </tr>

                                @forelse($kelas->guru as $index => $guru)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $index + 1 }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $guru->nama }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $guru->nip }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum
                                            ada guru di kelas ini.</td>
                                    </tr>
                                @endforelse

                                <tr>
                                    <td colspan="3" class="px-6 py-2 bg-gray-100 dark:bg-gray-700">
                                        <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                            Daftar Siswa ({{ $kelas->siswa->count() }} orang)
                                        </h4>
                                    </td>
                                </tr>

                                @forelse($kelas->siswa as $index => $siswa)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $index + 1 }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $siswa->nama }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                            {{ $siswa->nis }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">Belum
                                            ada siswa di kelas ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
