<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function staff(){
        return view('staff::dashboard',['title'=>trans('admin.humanResource')]);
    }
    public function admission(){
        return view('admission::dashboard',['title'=>trans('admission::admission.admissionDepartment')]);
    }    
}