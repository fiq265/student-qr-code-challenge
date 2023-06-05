<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('index', compact('students'));
    }

    public function store(Request $request)
    {
        try{

            $validated = $request->validate([
                'upload_file' => 'required|mimes:xlsx',
            ]);

            Excel::import(new StudentsImport, $request->upload_file);

            return redirect('/')->with('success', 'Student data successfully imported.');
        }catch(Exception $e){
            
            return redirect('/')->with('error', 'Unexpected error occured.');
        }
        
        
    }
}
