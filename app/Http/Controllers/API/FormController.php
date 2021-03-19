<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        // melakukan validasi
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        // menginstan studen
        $student = new Student;
        $student->nama = $request->nama;
        $student->alamat = $request->alamat;
        $student->no_telp = $request->no_telp;
        // menambahkan data ke database
        $student->save();

        // mengembalikan json
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
        // melakukan validasi
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ]);

        // mengambil semua data pada form request
        $data = $request->all();
        // mencari student berdasarkan id
        $student = Student::find($id);
        // mengUpdate student
        $student->update($data);

        // mengembalikan json
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
        // menghapus student berdasar kan id
        $student = Student::find($id)->delete();

        // mengembalikan json
        return response()->json(
            [
                "massage" => "data berhasil di hapus"
            ],
            200
        );
    }
}
