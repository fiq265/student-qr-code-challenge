<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithBatchInserts, WithChunkReading, WithStartRow, WithHeadingRow 
{
    public function model(array $row)
    {
        $student_check = Student::where('name', $row['name'])->where('class', $row['class'])->where('level', $row['level'])->first();

        if(empty($student_check)){
            return new Student([
                'name'              => $row['name'],
                'class'             => $row['class'], 
                'level'             => $row['level'],
                'parent_contact'    => $row['contact'],
            ]);
        }
    }

    public function batchSize() : int
    {
        return 1000;
    }

    public function chunkSize() : int
    {
        return 5000;
    }

    public function startRow(): int
    {
        return 2;
    }
}
