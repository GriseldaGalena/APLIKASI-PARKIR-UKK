<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\LogAktivitas;
use App\Models\Tarif;
use App\Models\Transaksi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $area = $request->query('area', null);
        $data = Transaksi::with(['kendaraan', 'area', 'user', 'tarif']);
            if($area) {
                $data = $data->where('id_area', $area);
            }
            $data = $data->paginate(10);
        return view('petugas.transaksi.index', [
            'transaksis' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Ambil area dari query
    $areaId = request()->query('area', null);

    return view('petugas.transaksi.create', [

        // Semua kendaraan
        'kendaraans' => Kendaraan::all(),

        // Tarif sesuai area
        'tarifs' => Tarif::where('area_parkir_id', $areaId)->get(),

        // Area yang masih tersedia
        'areas' => AreaParkir::whereColumn('terisi', '<', 'kapasitas')->get(),

        // 🔥 Kendaraan yang MASIH parkir (belum keluar)
        'kendaraanAktif' => Transaksi::whereNull('waktu_keluar')
            ->with('area')
            ->get()
            ->keyBy('id_kendaraan'),
    ]);
}


    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        // \Illuminate\Support\Facades\Log::error('VALIDASIII');
        $validated = $request->validate([
            'id_kendaraan' => 'required|exists:kendaraans,id',
            'waktu_masuk' => 'nullable|datetime',
            'waktu_keluar' => 'nullable|datetime|after:waktu_masuk',
            'id_tarif' => 'required|exists:tarifs,id',
            'id_area' => 'required|exists:area_parkirs,id',
            'durasi_jam' => 'nullable|integer|min:0',
            'biaya_total' => 'nullable|decimal:10,0',
            'status' => 'nullable|in:masuk,keluar',
        ], [
        ]);
        // \Illuminate\Support\Facades\Log::error('TESSS VALIDASII BERHASIL');

        try {
        DB::beginTransaction();
        // Ambil data yang diperlukan
        $area = AreaParkir::findOrFail($validated['id_area']);
        $kendaraan = Kendaraan::findOrFail($validated['id_kendaraan']);

        // Cek kapasitas area parkir
        if ($area->terisi >= $area->kapasitas) {
            return back()
                ->withInput()
                ->with('error', 'Area parkir ' . $area->nama_area . ' sudah penuh!');
        }

        // Cek apakah kendaraan sudah dalam status parkir
            $transaksiAktif = Transaksi::with('areaParkir')
                ->where('id_kendaraan', $validated['id_kendaraan'])
                ->where('status', 'masuk')
                ->first();


        if ($transaksiAktif) {

        // Jika kendaraan masih parkir di area LAIN
        if ($transaksiAktif->id_area != $validated['id_area']) {
            return back()
                ->withInput()
                ->with('error',
                    'Kendaraan ' . $kendaraan->plat_nomor .
                    ' masih berada di area parkir ' .
                    $transaksiAktif->area->nama_area
                );
        }

        // Jika masih parkir di area yang sama
        return back()
            ->withInput()
            ->with('error',
                'Kendaraan ' . $kendaraan->plat_nomor .
                ' masih terdaftar masuk di area ini'
            );
        }


        // Simpan transaksi
        Transaksi::create([
            'id_kendaraan' => $validated['id_kendaraan'],
            'id_area' => $validated['id_area'],
            'id_tarif' => $validated['id_tarif'],
            'id_user' => Auth::user()->id,
            'waktu_masuk' => now(),
            'status' => 'masuk',
        ]);

        // Update area terisi
        $area->increment('terisi');

        // Log aktivitas
        LogAktivitas::create([
            'id_user' => Auth::user()->id,
            'aktivitas' => 'Kendaraan masuk: ' . $kendaraan->plat_nomor . ' - Area: ' . $area->nama_area,
            'waktu_aktivitas' => now(),
        ]);

        DB::commit();

        return redirect()
            ->route('petugas.transaksi.index')
            ->with('success', 'Kendaraan ' . $kendaraan->plat_nomor . ' berhasil masuk parkir!');
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->route('petugas.transaksi.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::select(['id', 'plat_nomor', 'jenis_kendaraan', 'warna', 'pemilik'])->get();
        $tarif = Tarif::select(['id', 'jenis_kendaraan', 'harga_per_jam'])->get();
        $area = AreaParkir::select(['id', 'nama_area', 'kapasitas', 'terisi'])->get();
        $user = User::select(['id', 'name'])->get();
        $data = Transaksi::findOrFail($id);
        return view('petugas.transaksi.update', [
            'data' => $data,
            'kendaraan' => $kendaraan,
            'tarif' => $tarif,
            'area' => $area,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'id_kendaraan' => 'required|exists:kendaraans,id',
        'id_area' => 'required|exists:area_parkirs,id',
    ]);

    $validated['waktu_keluar'] = now();

    try {
        DB::beginTransaction();

        $transaksi = Transaksi::with(['kendaraan', 'area'])->findOrFail($id);

        // Ambil kendaraan
        $kendaraan = Kendaraan::findOrFail($validated['id_kendaraan']);

        // Cari tarif sesuai area & jenis kendaraan
        $tarif = Tarif::where('area_parkir_id', $validated['id_area'])
            ->where('jenis_kendaraan', $kendaraan->jenis_kendaraan)
            ->firstOrFail();

        // Hitung durasi
        $waktuMasuk  = Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = Carbon::parse($validated['waktu_keluar']);

        $durasiJam = ceil($waktuMasuk->diffInMinutes($waktuKeluar) / 60);
        $biayaTotal = $durasiJam * $tarif->tarif_per_jam;

        // Data yang diupdate
        $transaksi->update([
            'id_kendaraan' => $validated['id_kendaraan'],
            'id_area'      => $validated['id_area'],
            'id_tarif'     => $tarif->id,
            'durasi_jam'   => $durasiJam,
            'biaya_total'  => $biayaTotal,
            'status'       => 'keluar',
            'waktu_keluar' => $validated['waktu_keluar'],
        ]);

        // Kurangi slot area parkir
        $transaksi->area()->decrement('terisi');

        LogAktivitas::create([
            'id_user' => Auth::id(),
            'aktivitas' => 'Kendaraan keluar: ' 
                . $kendaraan->plat_nomor 
                . ' - Area: ' 
                . $transaksi->area->nama_area,
            'waktu_aktivitas' => now(),
        ]);

        DB::commit();
        return redirect()
            ->route('petugas.transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()
            ->route('petugas.transaksi.index')
            ->with('error', 'Transaksi gagal diperbarui.');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Transaksi::findOrFail($id);
            $data->area()->decrement('terisi');
            $data->delete();

            return redirect()->route('petugas.transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
            } catch(\Exception $e) {
            return redirect()->route('petugas.transaksi.index')->with('error', 'Transaksi gagal dihapus.');

        }
    }

    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'area', 'tarif'])->findOrFail($id);

        $pdf = Pdf::loadView('petugas.transaksi.struk', compact('transaksi'))->setPaper([0, 0, 226, 350]);

        return $pdf->stream('struk_parkir'. $transaksi->id . 'pdf');
    }
}