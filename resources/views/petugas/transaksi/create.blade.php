<x-layouts.app :title="__('Kendaraan Masuk')">

    {{-- SELECT2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- HEADER --}}
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-blue-600">Kendaraan Masuk Parkir</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Input data kendaraan yang masuk area parkir.
            </p>
        </div>
        <a href="{{ route('petugas.transaksi.index') }}"
           class="flex items-center gap-2 px-4 py-2 text-gray-700 dark:text-gray-300
                  hover:bg-gray-100 dark:hover:bg-gray-700 text-sm font-medium rounded-lg transition">
            ← Kembali
        </a>
    </div>

    {{-- FORM --}}
    <div class="mt-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg border
                border-gray-200 dark:border-gray-700 p-8">
        <form action="{{ route('petugas.transaksi.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- PILIH KENDARAAN --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Pilih Kendaraan <span class="text-red-500">*</span>
                </label>

                <input type="hidden" name="id_area" value="{{ request()->query('area', null) }}">

                <select name="id_kendaraan" id="id_kendaraan" required class="select-search w-full">
                    <option value="">Pilih kendaraan</option>

                    @foreach($kendaraans as $kendaraan)

                    @php
                        $aktif = $kendaraanAktif->get($kendaraan->id);
                    @endphp

                    <option value="{{ $kendaraan->id }}"
                        data-jenis="{{ $kendaraan->jenis_kendaraan }}"
                        @if($aktif) disabled @endif>

                    {{ $kendaraan->plat_nomor }}

                    @if($aktif)
                        — 🚫 Sudah parkir di {{ $aktif->area->nama_area }}
                    @else
                        — {{ ucfirst($kendaraan->jenis_kendaraan) }}
                    @endif


                    </option>

                    @endforeach
                </select>

            </div>

            {{-- TARIF OTOMATIS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Tarif Parkir
                </label>

                <select name="id_tarif" id="id_tarif" readonly
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600
                               rounded-lg bg-gray-100 dark:bg-gray-900
                               text-gray-900 dark:text-gray-100">
                    <option value="">Tarif otomatis</option>
                    @foreach($tarifs as $tarif)
                        <option value="{{ $tarif->id }}"
                                data-jenis="{{ $tarif->jenis_kendaraan }}">
                            {{ ucfirst($tarif->jenis_kendaraan) }} -
                            Rp {{ number_format($tarif->tarif_per_jam) }}/jam
                        </option>
                    @endforeach
                </select>

                <p class="mt-1 text-xs text-gray-500">
                    Tarif dipilih otomatis sesuai jenis kendaraan
                </p>
            </div>

            {{-- TOMBOL --}}
            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('petugas.transaksi.index') }}"
                   class="px-4 py-2 text-gray-700 dark:text-gray-300
                          hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700
                               text-white font-medium rounded-lg shadow">
                    Simpan Transaksi
                </button>
            </div>

        </form>
    </div>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- SELECT2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- SCRIPT --}}
    <script>
$(document).ready(function () {

    // Aktifkan Select2
    $('#id_kendaraan').select2({
        placeholder: 'Pilih atau ketik kendaraan',
        allowClear: true,
        width: '100%'
    });

    // TARIF OTOMATIS (FIX)
    $('#id_kendaraan').on('change', function () {

        // Ambil data dari Select2
        const selectedData = $('#id_kendaraan').select2('data')[0];
        const jenis = selectedData?.element?.dataset?.jenis || '';

        const tarifSelect = $('#id_tarif');
        tarifSelect.val('');

        tarifSelect.find('option').each(function () {
            if ($(this).data('jenis') === jenis) {
                tarifSelect.val($(this).val());
            }
        });

    });

});
</script>


</x-layouts.app>
