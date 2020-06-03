<?php
namespace App\Http\Traits;
use Excel;
use Illuminate\Http\Request;

trait ExcelConverter{
	public static function excelFile($fileName,$data)
	{
		return Excel::create($fileName, function($excel) use ($data) {
            $excel->sheet('sheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('xlsx');
	}

}