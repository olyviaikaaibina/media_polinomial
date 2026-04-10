<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
  public function index(Request $request)
{
    $query = Siswa::query();

    // FILTER KELAS
    if ($request->filled('kelas')) {
        $query->where('kelas', $request->kelas);
    }

    $siswas = $query->paginate(10)->withQueryString();

    return view('guru.daftarsiswa', compact('siswas'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:100',
            'nis' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:L,P',
            'kelas' => 'required|string|max:50|in:XI 1,XI 2,XI 3',
            'password' => 'required|min:6',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('daftarsiswa')
            ->with('success', 'Siswa berhasil ditambahkan');
    }
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);

        return response()->json($siswa);
    }

    // Method lain bisa kamu isi sesuai kebutuhan
    public function edit(string $id)
    { /* ... */
    }
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:100|unique:siswa,email,' . $id,
            'kelas' => 'required|string|max:50|in:XI 1,XI 2,XI 3',
            'nis' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'nullable|min:6',
        ]);

        $data = $request->only([
            'nama',
            'email',
            'kelas',
            'nis',
            'jenis_kelamin',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()
            ->route('daftarsiswa')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()
            ->route('daftarsiswa')
            ->with('success', 'Siswa berhasil dihapus');
    }
    public function exportPdf()
    {
        $siswas = \App\Models\Siswa::orderBy('id', 'desc')->get();
        $pdf = Pdf::loadView('guru.daftarsiswa_pdf', compact('siswas'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('daftar_siswa.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new SiswaExport, 'daftar_siswa.xlsx');
    }

}


