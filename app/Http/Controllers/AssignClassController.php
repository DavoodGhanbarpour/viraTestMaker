<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignClassController extends Controller
{
    public function index()
    {
        $params['classes'] =  DB::table('classes')->
        join('users', 'users.id', '=', 'classes.teacherID')->
        join('courses', 'courses.id', '=', 'classes.courseID')->
        join('semesters', 'semesters.id', '=', 'classes.semesterID')->
        join('assignees', 'assignees.classID', '=', 'classes.id')->
        select([ 'users.name as teacherName', 'courses.title as courseTitle', 'classes.*', 'semesters.title as semesterTitle' ])->
        addSelect(DB::raw('count(assignees.id) as studentCount'))->
        where([ 
            [ 'classes.trash', '<>', trashed() ], 
            [ 'courses.trash', '<>', trashed() ], 
            [ 'users.trash', '<>', trashed() ], 
            [ 'semesters.trash', '<>', trashed() ],
            [ 'assignees.trash', '<>', trashed() ],
        ])->groupby('assignees.classID')->get()->toArray();
        // varDumper($params);

        return view('pages.assignees.index', $params);
    }



    public function editAssignee( $classID )
    {
        $students   = DB::table('assignees')->select(['studentID'])->where([ [ 'assignees.trash', '<>', trashed() ], [ 'classID', '=', $classID ] ])->get()->toArray();
        foreach ($students as $value) 
            $assignees[] = $value->studentID;
        
        $params = [
            'classID'   => $classID,
            'students'  => DB::table('users')->select('*')->where([ [ 'trash', '<>', trashed() ] ,[ 'role', '=', 'STUDENT' ] ])->get()->toArray(),
            'assignees' => $assignees,
        ];
        return view('pages.assignees.edit', $params);
    }


    public function classAssignees( $classID )
    {
        $result     = [];
        $students   = DB::table('assignees')->join('users', 'users.id', '=', 'assignees.studentID')->select(['users.name as studentName'])->where([ [ 'assignees.trash', '<>', trashed() ],[ 'users.trash', '<>', trashed() ], [ 'classID', '=', $classID ] ])->get()->toArray();
        foreach ($students as $value) 
            $result[] = $value->studentName;

        $params     = [
            'assignees'   => $result,
        ];
        return response()->json($params,200);
    }


    
    public function updateAssignee( Request $request, $classID )
    {
        DB::table('assignees')
        ->where('classID', '=' ,$classID)
        ->update([ 'trash' => trashed() ]);

        $inputs         = $request->input(); 
        $dataToUpdate   = [];
        foreach ($inputs['students'] as $eachStudentID) 
            $dataToUpdate[]   = [
                'classID'       => $classID,
                'studentID'     => $eachStudentID,
            ];
        DB::table('assignees')->insert($dataToUpdate );
        
        return redirect('/assignees')->with('flashMessage', messageErrors( 200 ) );
    }


}
