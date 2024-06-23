<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;
use App\Models\Sekolah;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // Menampilkan daftar semua sekolah.
    {
        //
        $sekolahs = Sekolah::all(); // Mengambil semua data sekolah dari model Sekolah.
        return view('sekolahs.index', [
            'sekolahs' => $sekolahs
        ]); // Mengembalikan view sekolahs.index dengan data sekolah yang telah diambil sebelumnya.
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // Menampilkan formulir untuk membuat sekolah baru.
    {
        return view('sekolahs.create');
    } // Mengembalikan view formulir untuk membuat sekolah baru.

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // Menyimpan data sekolah yang baru dibuat ke dalam basis data.
    {
        echo "<script>console.log('Debug Objects: " . $request->namasekolah . "' );</script>";
        $sekolah = new Sekolah;
        $sekolah->namasekolah = $request->namasekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->longitude = $request->longitude;
        $sekolah->latitude = $request->latitude;
        $sekolah->save();
// Membuat dan menyimpan objek sekolah baru ke dalam basis data berdasarkan data yang diterima dari request.
        return redirect()->route('sekolahs.index')->with('success', 'Data Sekolah Berhasil Ditambahkan');
    }
// //  Mengarahkan kembali ke daftar sekolah dengan pesan sukses.

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // Menampilkan detail dari satu sekolah.
    {
        //
        $sekolah = Sekolah::findOrFail($id); // Mengambil data sekolah berdasarkan ID yang diberikan.
        return view('sekolahs.show', [
            'sekolah' => $sekolah
        ]); // Mengembalikan view yang menampilkan detail sekolah.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // Menampilkan formulir untuk mengedit sekolah.
    {
        //
        $sekolah = Sekolah::findOrFail($id); // Mengambil data sekolah yang akan diubah berdasarkan ID yang diberikan.
        return view('sekolahs.edit', [
            'sekolah' => $sekolah
        ]); // Mengembalikan view formulir untuk mengedit sekolah.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // Memperbarui data sekolah yang ada.
    {
        //

        $sekolah = Sekolah::findOrFail($id); // Mengambil data sekolah yang akan diubah berdasarkan ID yang diberikan.
        $sekolah->namasekolah = $request->namasekolah;
        $sekolah->alamat = $request->alamat;
        $sekolah->longitude = $request->longitude;
        $sekolah->latitude = $request->latitude;
        $sekolah->save();

        return redirect()->route('sekolahs.index')->with('success', 'Data sekolah berhasil diupdate.');
    } // Mengarahkan kembali ke daftar sekolah dengan pesan sukses.

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // Menghapus data sekolah.
    {
        //

        $sekolah = Sekolah::findOrFail($id); // Mengambil data sekolah yang akan dihapus berdasarkan ID yang diberikan.
        $sekolah->delete();

        return redirect()->route('sekolahs.index')->with('success', 'Data sekolah berhasil dihapus.'); 
        // Mengarahkan kembali ke daftar sekolah dengan pesan sukses setelah data sekolah berhasil dihapus.
    }
}