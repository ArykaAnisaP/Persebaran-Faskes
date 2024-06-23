<?php

namespace App\Http\Controllers;

use App\Models\hospital;
use Illuminate\Http\Request;

class hospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hospitals = hospital::all();
        return view('hospitals.index', [
            'hospitals' => $hospitals
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "<script>console.log('Debug Objects: " . $request->namahospital . "' );</script>";
        $hospital = new Hospital();
        $hospital->namahospital = $request->namahospital;
        $hospital->alamat = $request->alamat;
        $hospital->latitude = $request->latitude;
        $hospital->longitude = $request->longitude;
        $hospital->jambuka = $request->jambuka;
        $hospital->jamtutup = $request->jamtutup;
        $hospital->layanan = $request->layanan;
        $hospital->save();

        return redirect()->route('hospitals.index')->with('success', 'Data hospital Berhasil Ditambahkan');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $hospital = hospital::findOrFail($id);
        return view('hospitals.show', [
            'hospital' => $hospital
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $hospital = hospital::findOrFail($id);
        return view('hospitals.edit', [
            'hospital' => $hospital
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $hospital = Hospital::findOrFail($id);
        $hospital->namahospital = $request->namahospital;
        $hospital->alamat = $request->alamat;
        $hospital->longitude = $request->longitude;
        $hospital->latitude = $request->latitude;
        $hospital->jambuka = $request->jambuka;
        $hospital->jamtutup = $request->jamtutup;
        $hospital->layanan = $request->layanan;
        $hospital->save();

        return redirect()->route('hospitals.index')->with('success', 'Data hospital berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $hospital = hospital::findOrFail($id);
        $hospital->delete();

        return redirect()->route('hospitals.index')->with('success', 'Data hospital berhasil dihapus.');
    }
    public function welcome()
    {
       $hospitals = Hospital::all();
       return view('welcome', [
           'hospitals' => $hospitals
        ]);
    }
}