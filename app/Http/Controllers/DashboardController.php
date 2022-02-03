<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $freeDisk   = getFreeStorageAsGigabyte(storage_path());
        $totalDisk  = getFullStorageAsGigabyte();
        $usedDisk   = $totalDisk - $freeDisk;

        $params     = [
            'cards' => 
                [ 
                    'teachersCount' => DB::table('users')->where([ [ 'trash', '<>', trashed() ], [ 'role', '=', 'TEACHER' ], ])->count(),
                    'studentsCount' => DB::table('users')->where([ [ 'trash', '<>', trashed() ], [ 'role', '=', 'STUDENT' ], ])->count(),
                    'coursesCount'  => DB::table('courses')->where([ [ 'trash', '<>', trashed() ] ])->count(),
                ],
            'systemStatics' => 
                [
                    'totalDisk'     => $totalDisk,   
                    'usedDisk'      => $usedDisk,   
                    'freeDisk'      => $freeDisk,   
                    'usedPercent'   => round( ( $usedDisk / $totalDisk ) * 100 ),   
                ],
        ];

        if( Auth::user()->role == 'TEACHER' )
        {
            $params['exams'] =  DB::table('exams')->
            join('classes', 'classes.id', '=', 'exams.classID')->
            join('users', 'users.id', '=', 'classes.teacherID')->
            join('courses', 'courses.id', '=', 'classes.courseID')->
            join('semesters', 'semesters.id', '=', 'classes.semesterID')->
            join('assignees', 'assignees.classID', '=', 'exams.classID')->
            select([ 'users.name as teacherName', 'courses.title as courseTitle', 'exams.*', 'classes.title as classTitle', 'semesters.title as semesterTitle' ])->
            where([ 
                [ 'classes.teacherID', '=', Auth::user()->id ], 
                [ 'assignees.trash', '<>', trashed() ], 
                [ 'classes.trash', '<>', trashed() ], 
                [ 'courses.trash', '<>', trashed() ], 
                [ 'users.trash', '<>', trashed() ], 
                [ 'exams.trash', '<>', trashed() ], 
                [ 'exams.dateStart', '>=', time() - ( 86400 ) ], 
                [ 'exams.dateStart', '<=', time() + ( 86400 * 5 ) ], 
            ])->get()->toArray();
        }
        else if( Auth::user()->role == 'STUDENT' )
        {
            $params['exams'] =  DB::table('exams')->
            join('classes', 'classes.id', '=', 'exams.classID')->
            join('users', 'users.id', '=', 'classes.teacherID')->
            join('courses', 'courses.id', '=', 'classes.courseID')->
            join('semesters', 'semesters.id', '=', 'classes.semesterID')->
            join('assignees', 'assignees.classID', '=', 'exams.classID')->
            select([ 'users.name as teacherName', 'courses.title as courseTitle', 'exams.*', 'classes.title as classTitle', 'semesters.title as semesterTitle' ])->
            where([ 
                [ 'assignees.studentID', '=', Auth::user()->id ], 
                [ 'assignees.trash', '<>', trashed() ], 
                [ 'classes.trash', '<>', trashed() ], 
                [ 'courses.trash', '<>', trashed() ], 
                [ 'users.trash', '<>', trashed() ], 
                [ 'exams.trash', '<>', trashed() ], 
                [ 'exams.dateStart', '>=', time() - ( 86400 ) ], 
                [ 'exams.dateStart', '<=', time() + ( 86400 * 5 ) ], 
            ])->get()->toArray();
        }
        else 
            $params['exams'] = [];
            
        return view('pages.dashboard.index', $params);
    }
}
