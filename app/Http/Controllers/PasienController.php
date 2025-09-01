<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index()
    {
        $rumahSakits = RumahSakit::get();
        return view('pasien.index.index', compact('rumahSakits'));
    }

    public function search(Request $request)
    {
        $query = Pasien::query();

        if ($request->filled('nama')) {
            $query->where('nama', 'LIKE', '%' . $request->nama . '%');
        }
        if ($request->filled('rumah_sakit_id')) {
            $query->where('rumah_sakit_id', $request->rumah_sakit_id);
        }

        $data_search = $query->with('rumahSakit')
            ->select('id', 'nama', 'alamat', 'no_telepon', 'rumah_sakit_id')
            ->orderBy('id')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'alamat' => $item->alamat,
                    'no_telepon' => $item->no_telepon,
                    'rumah_sakit_nama' => $item->rumahSakit ? $item->rumahSakit->nama : '-',
                ];
            });

        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'rumah_sakit_id' => 'required|exists:rumah_sakit,id',
        ]);
        try {
            DB::beginTransaction();
            Pasien::create($validated);

            DB::commit();
            return redirect('pasien')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('pasien')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pasien,email,' . $id,
            'telepon' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();
            $data_item = Pasien::findOrFail($id);
            $data_item->update($validated);

            DB::commit();
            return redirect('pasien')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('pasien')->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = Pasien::find($id);
        }
        $rumahSakit = RumahSakit::get();
        $data['item'] = $item;
        $data['method'] = $method;
        $data['rumahSakit'] = $rumahSakit;
        return view('pasien.form.index', $data);
    }

    public function singleView($kode)
    {
        $data['data'] = Pasien::with('rumahSakit')->where('kode', $kode)->first();
        return view('pasien.single.index', $data);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $item = Pasien::with('rumahSakit')->findOrFail($id);

            $item->delete();
            DB::commit();
            return redirect('pasien')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('pasien')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
