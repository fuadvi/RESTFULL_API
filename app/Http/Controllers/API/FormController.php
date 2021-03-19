<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        $student = new Student;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_telp = $request->no_telp;
        $student->save();

        return response()->json(
            [
                'massage' => 'Data Berhasil di Tambah',
                'data_student' => $student
            ],
            200
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $student = Student::find($id);
        $student->update($data);

        return response()->json(
            [
                'massage' => "Data Student Berhasil di ubah",
                'data_student' => $student
            ],
            200
        );
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();

        return response()->json(
            [
                "massage" => "data berhasil di hapus"
            ],
            200
        );
    }
}
