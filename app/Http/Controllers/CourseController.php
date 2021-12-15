<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {

        switch (Auth::user()->role) 
        {
            case 'STUDENT':
                return $this->studentCourses();
                break;

            case 'TEACHER':
                return $this->teacherCourses();
            break;

            case 'ADMIN':
                return $this->adminCourses();
                break;
        }
    }
    
    public function adminCourses()
    {

        $params = [
            'courses' => DB::table('courses')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        
        return view('pages.courses.admin', $params);
    }

    public function teacherCourses()
    {
        $params = [];
        return view('pages.courses.teacher', $params);
    }

    public function studentCourses()
    {
        $params = [];
        return view('pages.courses.student', $params);
    }


    public function addCourse( $parentCode )
    {
        $params = [
            'parentCourse' =>  DB::table('courses')->select('*')->where([ ['trash', '<>', trashed() ], [ 'level', '=', '1' ] ])->get()->toArray(),
        ];
        return view('pages.courses.add', $params);
    }
    
}
