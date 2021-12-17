<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendences = Attendence::all();
    
        return view('attendences.index',compact('attendences'), [
            'i' => 1
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::all();
        return view('attendences.create',compact('students'));
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
            'nis' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|file|max:1024'
        ]);

        $doubleSS = Attendence::where([
            'nis' => $valided['nis'],
            'tanggal' => $date
        ])->count();

        if ($doubleSS > 0) {
            return redirect()->route('attendences.index')->with('sudah absen','Student have filled in the days absence, please fill it again tomorrow');
        };

        $valided['foto'] = $request->file('foto')->store('keterangan-tidak-hadir');

        Attendence::create([
            'nis' => $valided['nis'],
            'foto' => $valided['foto'],
            'tanggal' => $date,
            'keterangan' => $valided['keterangan']
        ]);

        return redirect()->route('attendences.index')->with('notPresentsSuccess','Sended!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function show(Attendence $attendence)
    {

        return view('attendences.show',compact('attendence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendence $attendence)
    {
        $students = Student::all();
        if ($attendence['keterangan'] == "Hadir") {
            return view('attendences.edit',compact('attendence','students'));
        }elseif ($attendence['keterangan' == "Hadir namun belum mengisi absen pulang"]) {
            return view('attendences.edit',compact('attendence','students'));
        }else {
            return redirect()->route('attendences.index')->with('cant edit','only those present whose data can be edited');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendence $attendence)
    {
        $date = date("Y-m-d");
        $valided = $request->validate([
            'nis' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|file|max:1024'
        ]);

        $valided['foto'] = $request->file('foto')->store('keterangan-tidak-hadir');

        $attendence->update([
            'nis' => $valided['nis'],
            'jam_kedatangan' => '',
            'jam_kepulangan' => '',
            'tanggal' => $date,
            'keterangan' => $valided['keterangan'],
            'foto' => $valided['foto']
        ]);

        return redirect()->route('attendences.index')->with('berhasil edit','data changed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendence  $attendence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendence $attendence)
    {
        $attendence->delete();

        return redirect()->route('attendences.index')->with('berhasil hapus', 'data deleted successfully');
    }
}
