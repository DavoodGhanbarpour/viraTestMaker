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
            'exams'       => DB::table('Exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
          
        ];
        
        return view('pages.exams.admin', $params);
    }

    public function teacherExams()
    {
        $params = [
            'exams'       => DB::table('Exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];
        
        return view('pages.exams.teacher', $params);
    }

    public function studentExams()
    {
        $params = [
            'exams'       => DB::table('Exams')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
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
            'course'        => DB::table('Exams')->select('*')->where([ ['trash', '<>', trashed() ], ['id', '=', $courseID ] ])->get()->first(),
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
        // varDumper($inputs);
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
       varDumper($dataToInsert);
        $insertedID = DB::table('Exams')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/Exams')->with('flashMessage', messageErrors( 200 ) );
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
       
        $insertedID     = DB::table('Exams')->where('id',$courseID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/Exams')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }
}
