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
            'courses'       => DB::table('courses')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
            'categories'    => $this->assocArrayOfCategories(),
        ];
        
        return view('pages.courses.admin', $params);
    }

    public function teacherCourses()
    {
        $params = [
            'courses'       => DB::table('courses')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
            'categories'    => $this->assocArrayOfCategories(),
        ];
        
        return view('pages.courses.teacher', $params);
    }

    public function studentCourses()
    {
        $courses =  DB::table('classes')->
        join('users', 'users.id', '=', 'classes.teacherID')->
        join('courses', 'courses.id', '=', 'classes.courseID')->
        join('semesters', 'semesters.id', '=', 'classes.semesterID')->
        join('assignees', 'assignees.classID', '=', 'classes.id')->
        join('categories', 'categories.id', '=', 'courses.categoryID')->
        select([ 'semesters.title as semesterTitle', 'courses.title as courseTitle', 'courses.title as categoryTitle', 'classes.timeStart','classes.timeFinish', 'users.name as teacherName', 'classes.id as classID'   ])->
        where([ 
            [ 'classes.trash', '<>', trashed() ], 
            [ 'courses.trash', '<>', trashed() ], 
            [ 'users.trash', '<>', trashed() ], 
            [ 'semesters.trash', '<>', trashed() ],
            [ 'assignees.trash', '<>', trashed() ],
            [ 'assignees.studentID', '=', Auth::user()->id ],
        ])->groupby('assignees.classID')->get()->toArray();
        // varDumper($courses);

        $params = [
            'courses'       => $courses,
        ];
        
        return view('pages.courses.student', $params);
    }


    public function addCourse()
    {
        $params = [
            'categories'    => DB::table('categories')->select('*')->where([ ['trash', '<>', trashed() ] ])->get()->toArray()
        ];
        return view('pages.courses.add', $params);
    }

    public function editCourse( $courseID )
    {
        $params = [
            'categories'    => DB::table('categories')->select('*')->where([ ['trash', '<>', trashed() ] ])->get()->toArray(),
            'course'        => DB::table('courses')->select('*')->where([ ['trash', '<>', trashed() ], ['id', '=', $courseID ] ])->get()->first(),
        ];
        return view('pages.courses.edit', $params);
    }


    
    public function deleteCourse( $courseID )
    {
        $affected = DB::table('courses')
            ->where('id', '=' ,$courseID)
            ->update([ 'trash' => trashed() ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    public function insertCourse( Request $request )
    {
        $inputs         = $request->input(); 
        $dataToInsert   = [
            'title'         => $inputs['title'],
            'categoryID'    => $inputs['category'] ?? 0,
        ];
       
        $insertedID = DB::table('courses')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/courses')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

    public function updateCourse( Request $request, $courseID )
    {
        $inputs         = $request->input(); 
        $dataToUpdate   = [
            'title'         => $inputs['title'],
            'categoryID'    => $inputs['category'] ?? 0,
        ];
       
        $insertedID     = DB::table('courses')->where('id',$courseID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/courses')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }



    private function assocArrayOfCategories()
    {
        $result         = [];
        $courses        = DB::table('categories')->select('*')->where('trash', '<>', trashed())->get()->toArray();
        $result['']     = '???????? ??????????';
        foreach ($courses as $eachCourse)
        {
            $result[ $eachCourse->id ]   = $eachCourse->title;
        }
        return $result;
    }

    
}
