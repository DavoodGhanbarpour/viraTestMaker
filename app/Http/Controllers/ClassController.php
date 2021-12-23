<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class ClassController extends Controller
{
    public function index()
    {
        $params = [
            'classes' => DB::table('classes')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];

        return view('pages.classes.index', $params);
    }


    public function addClass()
    {
        return view('pages.classes.add');
    }



    public function editClass( $classID )
    {
        $params = [
            'class' => DB::table('classes')->select('*')->where([ [ 'trash', '<>', trashed() ], [ 'id', '=', $classID ] ])->get()->first(),
        ];
        return view('pages.classes.edit', $params);
    }


    public function insertclass(Request $request)
    {
        $semesterID = $this->isAnySemesterActive();
        if( !$semesterID )
            return back()->with('flashMessage', messageErrors( 404 ) );

        $inputs         = $request->input(); 
        
        $dataToInsert   = [
            'title'         => $inputs['title'],
            'semesterID'    => $semesterID,
            'code'          => $this->buildNextClassCode(),
            'timeStart'     => strtotime( toEngNumbers( $inputs['timeStart'] ) ),
            'timeFinish'    => strtotime( toEngNumbers( $inputs['timeFinish'] ) ),
        ];
       
        $insertedID = DB::table('classes')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/classes')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    
    public function updateClass( Request $request, $classID )
    {
        $inputs         = $request->input(); 
        $dataToUpdate   = [
            'title'         => $inputs['title'],
        ];
       
        $insertedID     = DB::table('classes')->where('id',$classID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/classes')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

        
    public function deleteClass( $classID )
    {
        $affected = DB::table('classes')
        ->where('id', '=' ,$classID)
        ->update([ 'trash' => trashed() ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    private function buildNextClassCode()
    {
        $lastInsertedCode   = DB::table('classes')->select('code')->where( 'trash', '<>', trashed() )->orderBy('id','desc')->get()->first()->code ?? 0;
        str_pad($lastInsertedCode, 7,"0", STR_PAD_LEFT);
        
        return $lastInsertedCode;
    }


    private function isAnySemesterActive()
    {
        $activeSemesterID   = DB::table('semesters')->select('id')->where([ [ 'trash', '<>', trashed() ], [ 'isActive', '=', 'true' ] ])->orderBy('id','desc')->get()->first()->id ?? 0;

        if( $activeSemesterID )
            return $activeSemesterID;
        else 
            return false;
    }
}
