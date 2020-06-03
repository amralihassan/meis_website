<?php

namespace App\Imports;

use Staff\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AttendanceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new Attendance([
            'attendance_id'     => $row['attendance_id'],
            'statusAttendnace'  => $row['status'],
            'timeAttendnace'    => $row['time'],
            'user_id'           => 1,

        ]);
    }
}
