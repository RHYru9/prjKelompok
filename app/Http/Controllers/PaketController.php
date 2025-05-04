<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;

class PaketController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()?->role !== 'admin') {
                abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
            }
            return $next($request);
        });
    }

    /**
     * Menampilkan daftar paket (dengan pencarian opsional).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pakets = Paket::when($search, function ($query, $search) {
            return $query->where('id_referensi', 'like', "%{$search}%")
                         ->orWhere('nama_pengirim', 'like', "%{$search}%")
                         ->orWhere('nama_penerima', 'like', "%{$search}%")
                         ->orWhere('jenis_paket', 'like', "%{$search}%")
                         ->orWhere('kategori', 'like', "%{$search}%")
                         ->orWhere('status', 'like', "%{$search}%");
        })
        ->orderByDesc('created_at')
        ->get();

        return view('paket.index', compact('pakets'));
    }

    /**
     * Tampilkan form tambah paket.
     */
    public function create()
    {
        return view('paket.create');
    }

    /**
     * Simpan data paket baru ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_referensi'     => 'required|unique:pakets,id_referensi',
            'nama_pengirim'    => 'required|string|max:255',
            'nama_penerima'    => 'required|string|max:255',
            'jenis_paket'      => 'required|string|max:100',
            'kategori'         => 'required|string|max:100',
            'berat_kg'         => 'required|numeric|min:0',
            'harga'            => 'required|numeric|min:0',
            'alamat_tujuan'    => 'required|string|max:255',
            'jenis_pengiriman' => 'required|in:cargo,motor,mobil',
            'status'           => 'required|in:Baru,Pending,Delay,Selesai',
        ]);

        Paket::create($data);

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit data paket.
     */
    public function edit(Paket $paket)
    {
        return view('paket.edit', compact('paket'));
    }

    /**
     * Simpan perubahan data paket.
     */
    public function update(Request $request, Paket $paket)
    {
        $data = $request->validate([
            'nama_pengirim'    => 'required|string|max:255',
            'nama_penerima'    => 'required|string|max:255',
            'jenis_paket'      => 'required|string|max:100',
            'kategori'         => 'required|string|max:100',
            'berat_kg'         => 'required|numeric|min:0',
            'harga'            => 'required|numeric|min:0',
            'alamat_tujuan'    => 'required|string|max:255',
            'jenis_pengiriman' => 'required|in:cargo,motor,mobil',
            'status'           => 'required|in:Baru,Pending,Delay,Selesai',
        ]);

        $paket->update($data);

        return redirect()->route('paket.index')->with('success', 'Data paket berhasil diperbarui.');
    }

    /**
     * Hapus data paket.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();

        return redirect()->back()->with('success', 'Data paket berhasil dihapus.');
    }

    /**
     * Perbarui status paket saja.
     */
    public function updateStatus(Request $request, Paket $paket)
    {
        $request->validate([
            'status' => 'required|in:Baru,Pending,Delay,Selesai',
        ]);

        $paket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('paket.index')->with('success', 'Status paket berhasil diperbarui.');
    }
}
