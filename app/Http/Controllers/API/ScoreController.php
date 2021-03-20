<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\score;
use Illuminate\Http\Request;
use App\Models\Student;

class ScoreController extends Controller
{
    public function create(Request $request)
    {
        // create student
        $student = new Student;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_telp = $request->no_telp;
        $student->save();

        // create score with relasi student
        foreach ($request->list_pelajaran as $key => $value) {
            $score = array(
                'student_id' => $student->id,
                'mata_pelajran' => $value["mata_pelajran"],
                'nilai' => $value['nilai']
            );

            $scores = score::create($score);
        }

        // mengembalikan json
        return response()->json(
            [
                'massage' => 'success'
            ],
            200
        );
    }


    public function getStudent($id)
    {
        $student = Student::with('score')->where('id', $id)->first();
        // dd($student);

        return response()->json(
            [
                'massage' => "success",
                'data_student' => $student
            ],
            200
        );
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        $student->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp
        ]);

        $score = score::where("student_id", $id)->delete();

        // create score with relasi student
        foreach ($request->list_pelajaran as $key => $value) {
            $score = array(
                'student_id' => $student->id,
                'mata_pelajran' => $value["mata_pelajran"],
                'nilai' => $value['nilai']
            );

            $scores = score::create($score);
        }

        return response()->json(
            [
                'massage' => "success",
            ],
            200
        );
    }
}
