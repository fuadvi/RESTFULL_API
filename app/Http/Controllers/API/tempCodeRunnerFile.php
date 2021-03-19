<?php
$data = $request->all();
        $student = Student::find($id);
        $student->update($data);