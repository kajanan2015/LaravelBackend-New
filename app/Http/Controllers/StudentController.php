<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return Student::all();
    }

    public function show($id)
    {
        return Student::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'student_id' => 'required|unique:students|string',
            'age' => 'required|integer',
            'grade' => 'required|string',
            'parents_phone_number' => 'required|string',
        ]);

        return Student::create($validatedData);
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'student_id' => 'required|string',
            'age' => 'required|integer',
            'grade' => 'required|string',
            'parents_phone_number' => 'required|string',
        ]);

        return $validatedData;

        $student = Student::findOrFail($id);
        $student->update($validatedData);
        return response()->json(['message' => 'Student updated successfully', 'data' => $student]);
    }



    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}

