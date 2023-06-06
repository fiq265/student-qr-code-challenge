<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\FailedData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithBatchInserts, WithChunkReading, WithStartRow, WithHeadingRow 
{
    public function model(array $row)
    {
        $deleted = FailedData::query()->delete();
        
        $student_check = Student::where('name', $row['name'])
                            ->where('class', $row['class'])
                            ->where('level', $row['level'])
                            ->where('parent_contact', $row['contact'])
                            ->first();

        if(empty($student_check)){

            if(!empty($row['name']) && !empty($row['class']) && !empty($row['level']) && !empty($row['contact'])){
                return new Student([
                    'name'              => $row['name'],
                    'class'             => $row['class'], 
                    'level'             => $row['level'],
                    'parent_contact'    => $row['contact'],
                ]);
            }else{
                return new FailedData([
                    'name'              => $row['name'],
                    'class'             => $row['class'], 
                    'level'             => $row['level'],
                    'parent_contact'    => $row['contact'],
                    'reason'            => 'Missing Data.',
                ]);
            }
        }else{
            return new FailedData([
                'name'              => $row['name'],
                'class'             => $row['class'], 
                'level'             => $row['level'],
                'parent_contact'    => $row['contact'],
                'reason'            => 'Duplicated data',
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
