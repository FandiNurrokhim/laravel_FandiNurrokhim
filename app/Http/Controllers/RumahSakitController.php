<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RumahSakitController extends Controller
{
    public function index()
    {
        return view('rumah_sakit.index.index');
    }

    public function search(Request $request)
    {
        $query = RumahSakit::query();

        if ($request->filled('nama')) {
            $query->where('nama', 'LIKE', '%' . $request->nama . '%');
        }
        if ($request->filled('alamat')) {
            $query->where('alamat', 'LIKE', '%' . $request->alamat . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }
        if ($request->filled('telepon')) {
            $query->where('telepon', 'LIKE', '%' . $request->telepon . '%');
        }

        $data_search = $query->with('pasien')
            ->select('id', 'nama', 'alamat', 'email', 'telepon')
            ->orderBy('id')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'alamat' => $item->alamat,
                    'email' => $item->email,
                    'telepon' => $item->telepon,
                    'jumlah_pasien' => $item->getJumlahPasien(),
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
            'email' => 'required|email|max:255|unique:rumah_sakit,email',
            'telepon' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();
            RumahSakit::create($validated);

            DB::commit();
            return redirect('rumah-sakit')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('rumah-sakit')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:rumah_sakit,email,' . $id,
            'telepon' => 'required|string|max:255',
        ]);
        try {
            DB::beginTransaction();
            $data_item = RumahSakit::findOrFail($id);
            $data_item->update($validated);

            DB::commit();
            return redirect('rumah-sakit')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('rumah-sakit')->with('error', 'Gagal mengupdate data: ' . $e->getMessage());
        }
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = RumahSakit::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('rumah_sakit.form.index', $data);
    }

    public function singleView($id)
    {
        $data['data'] = RumahSakit::with('pasien')->where('id', $id)->first();
        return view('rumah_sakit.single.index', $data);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $item = RumahSakit::with('pasien')->findOrFail($id);

            if ($item->masterItems()->exists()) {
                DB::rollBack();
                return redirect('rumah-sakit')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki relasi ke master items.');
            }

            $item->delete();
            DB::commit();
            return redirect('rumah-sakit')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('rumah-sakit')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
