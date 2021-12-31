<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index()
    {

        switch (Auth::user()->role) 
        {
            case 'STUDENT':
                return $this->studentExams();
                break;

            case 'TEACHER':
                return $this->teacherExams();
            break;

            case 'ADMIN':
                return $this->adminExams();
                break;
        }
    }
    
    public function adminExams()
    {

        $params = [
            'exams'       => DB::table('exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
            'teachers'    => $this->assocArrayOfTeachers(),
            'courses'     => $this->assocArrayOfCourses(),
        ];
        
        return view('pages.exams.admin', $params);
    }

    public function teacherExams()
    {
        $params = [
            'exams'       => DB::table('exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        
        return view('pages.exams.teacher', $params);
    }

    public function studentExams()
    {
        $params = [
            'exams'       => DB::table('exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        
        return view('pages.exams.student', $params);
    }


    public function addExam()
    {
        $params = [
            'classes'     => DB::table('courses')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        return view('pages.exams.add', $params);
    }

    public function editExam( $courseID )
    {
        $params = [
            'categories'    => DB::table('categories')->select('*')->where([ ['trash', '<>', trashed() ] ])->get()->toArray(),
            'course'        => DB::table('exams')->select('*')->where([ ['trash', '<>', trashed() ], ['id', '=', $courseID ] ])->get()->first(),
        ];
        return view('pages.exams.edit', $params);
    }


    
    public function deleteExam( $courseID )
    {
        $affected = DB::table('Exams')
            ->where('id', '=' ,$courseID)
            ->update([ 'trash' => trashed() ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    public function insertExam( Request $request )
    {
        $inputs         = $request->input(); 
        $dataToInsert   = [
            'title'             => $inputs['title'],
            'classID'           => $inputs['class'],
            'score'             => $inputs['score'],
            'dateStart'         => datepickerToTimestamp($inputs['dateStart']),
            'dateFinish'        => datepickerToTimestamp($inputs['dateFinish']),
            'timeStart'         => timepickerToTimestamp($inputs['timeStart']),
            'timeFinish'        => timepickerToTimestamp($inputs['timeFinish']),
            'isRandom'          => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isReviewAllowed'   => $inputs['random'] == 'TRUE' ? 'true' : 'false',
            'isMoveAllowed'     => $inputs['random'] == 'TRUE' ? 'true' : 'false',
        ];
        $insertedID = DB::table('exams')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/exams')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

    public function updateExam( Request $request, $courseID )
    {
        $inputs         = $request->input(); 
        $dataToUpdate   = [
            'title'         => $inputs['title'],
            'categoryID'    => $inputs['category'] ?? 0,
        ];
       
        $insertedID     = DB::table('exams')->where('id',$courseID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/exams')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }



    private function assocArrayOfCourses()
    {
        $result         = [];
        $courses        = DB::table('courses')->select('*')->where('trash', '<>', trashed())->get()->toArray();
        $result['']     = 'بدون عنوان';
        foreach ($courses as $eachCourse)
        {
            $result[ $eachCourse->id ]   = $eachCourse->title;
        }
        return $result;
    }


    private function assocArrayOfTeachers()
    {
        $result         = [];
        $teachers       = DB::table('users')->select('*')->where([ [ 'trash', '<>', trashed() ] ,[ 'role', '=', 'TEACHER' ] ])->get()->toArray();
        $result['']     = 'بدون عنوان';
        foreach ($teachers as $eachCourse)
        {
            $result[ $eachCourse->id ]   = $eachCourse->name;
        }
        return $result;
    }
}
