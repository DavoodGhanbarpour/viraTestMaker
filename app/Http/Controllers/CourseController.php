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
            'parentCourse'  => DB::table('courses')->select('*')->where([ ['trash', '<>', trashed() ], [ 'level', '=', '1' ] ])->get()->toArray(),
            'courses'       => $this->assocArrayOfCourses(),
            'parentCode'    => $parentCode,
        ];
        return view('pages.courses.add', $params);
    }


    public function insertCourse( Request $request )
    {
        $inputs         = $request->input(); 
        $parentCode     =$this->getLevelByParentCode( $inputs['parent'] );
        $dataToInsert   = [
            'title'         => $inputs['title'],
            'code'          => $this->getNextRowCodeByParentCode( $parentCode ),
            'level'         => $parentCode,
            'parent'        => $inputs['parent'],
        ];
       
var_dump($dataToInsert);die;
        $insertedID = DB::table('courses')->insertGetId($dataToInsert);

        if( $insertedID )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }



    public function nextCourseCode( Request $request )
    {
        return response()->json([ 
            'nextCode' => $this->getNextRowCodeByParentCode( $request->get('parentCode') )
        ], 200);
    }



    private function getNextRowCodeByParentCode($parent)
    {
        $lastCode = DB::table('courses')->select('code')->where([ ['trash', '<>', trashed() ], [ 'parent', '=', $parent ] ])->orderBy('code', 'desc')->limit(1)->first();

        try {
            if( !$lastCode->code )
                return '1';
        } catch (\Throwable $th) {
            return '01';
        }
        
        return $parent . $lastCode->code++;
    }



    private function assocArrayOfCourses()
    {
        $result  = [];
        $courses = DB::table('courses')->select('*')->where('trash', '<>', trashed())->get()->toArray();
        foreach ($courses as $eachCourse)
        {
            $result[ $eachCourse->code ]['title']   = $eachCourse->title;
            $result[ $eachCourse->code ]['level']   = $eachCourse->level;
            $result[ $eachCourse->code ]['code']    = $eachCourse->code;
        }


        return $result;
    }
    
}
