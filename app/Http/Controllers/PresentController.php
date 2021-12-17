<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('presents.present');
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
        $time = date("H:i:s");


        if (isset($request['btnIn'])) {

            $doubleSS = Attendence::where([
                'nis' => Auth::user()->user_id,
                'tanggal' => $date
            ])->count();

            if ($doubleSS > 0) {
                return redirect('/asStudent')->with('sudah absen','You have filled in the days absence, please fill it again tomorrow');
            };

            Attendence::create([
                'nis' => Auth::user()->user_id,
                'jam_kedatangan' => $time,
                'tanggal' => $date,
                'keterangan' => 'Hadir namun belum mengisi absensi pulang'
            ]);

            return back()->with('sampai','successfully sent the arrival time and dont forget to fill in the return time');

        }elseif (isset($request['btnOut'])) {
            $doublePS = Attendence::where([
                'nis' => Auth::user()->user_id,
                'jam_kepulangan' => NULL
            ])->count();

            if ($doublePS = 1) {
                Attendence::where([
                    'nis' => Auth::user()->user_id,
                    'tanggal' => $date
                ])->update([
                    'nis' => Auth::user()->user_id,
                    'jam_kepulangan' => $time,
                    'keterangan' => 'Hadir'
                ]);
                return back()->with('pulang','Successfully sent all absentees, you are here today, and dont forget to fill in again tomorrow :)');
            };
            
            return redirect()->back();

        }

        return "rusak";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function show(Present $present)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function edit(Present $present)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Present $present)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Present  $present
     * @return \Illuminate\Http\Response
     */
    public function destroy(Present $present)
    {
        //
    }
}
