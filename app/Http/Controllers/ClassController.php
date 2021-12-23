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
        if( !$this->isAnySemesterActive() )
            return back()->with('flashMessage', messageErrors( 404 ) );

        $inputs         = $request->input(); 
        
        $dataToInsert   = [
            'title'         => $inputs['title'],
            'code'          => $this->buildNextClassCode(),
            'timeStart'     => strtotime( toEngNumbers( $inputs['timeStart'] ) ),
            'timeFinish'    => strtotime( toEngNumbers( $inputs['timeFinish'] ) ),
        ];
        varDumper($dataToInsert);
       
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
        $year               = Jalalian::fromCarbon(Carbon::now())->getYear();
        $lastInsertedCode   = DB::table('classes')->select('code')->where( 'trash', '<>', trashed() )->orderBy('id','desc')->get()->first()->code ?? 0;
        $activeSemesterCode = DB::table('semesters')->select('code')->where([ [ 'trash', '<>', trashed() ], [ 'active', '=', 'true' ] ])->orderBy('id','desc')->get()->first()->code ?? 0;

        return $year.$activeSemesterCode.$lastInsertedCode;
    }


    private function isAnySemesterActive()
    {
        $activeSemester     = DB::table('semesters')->select('id')->where([ [ 'trash', '<>', trashed() ], [ 'isActive', '=', 'true' ] ])->orderBy('id','desc')->get()->first()->code ?? 0;

        if( $activeSemester )
            return true;
        else 
            return false;
    }
}
