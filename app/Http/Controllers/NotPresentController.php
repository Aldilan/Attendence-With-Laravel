<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotPresentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notpresents.notpresent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date("Y-m-d");
        $valided = $request->validate([
            'keterangan' => 'required',
            'foto' => 'image|file|max:1024'
        ]);

        $doubleSS = Attendence::where([
            'nis' => Auth::user()->user_id,
            'tanggal' => $date
        ])->count();

        if ($doubleSS > 0) {
            return redirect('/asStudent')->with('sudah absen','You have filled in the days absence, please fill it again tomorrow');
        };

        $valided['foto'] = $request->file('foto')->store('keterangan-tidak-hadir');

        Attendence::create([
            'nis' => Auth::user()->user_id,
            'foto' => $valided['foto'],
            'tanggal' => $date,
            'keterangan' => $valided['keterangan']
        ]);

        return back()->with('notPresentsSuccess','Sended!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotPresent  $notPresent
     * @return \Illuminate\Http\Response
     */
    public function show(NotPresent $notPresent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NotPresent  $notPresent
     * @return \Illuminate\Http\Response
     */
    public function edit(NotPresent $notPresent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotPresent  $notPresent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotPresent $notPresent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotPresent  $notPresent
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotPresent $notPresent)
    {
        //
    }
}
