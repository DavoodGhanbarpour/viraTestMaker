<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
    public function index()
    {
        $params = [
            'semesters' => DB::table('semesters')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];

        return view('pages.semesters.index', $params);
    }


    public function addSemester()
    {
        return view('pages.semesters.add');
    }



    public function editSemester( $semesterID )
    {
        $params = [
            'semester' => DB::table('semesters')->select('*')->where([ [ 'trash', '<>', trashed() ], [ 'id', '=', $semesterID ] ])->get()->first(),
        ];
        return view('pages.semesters.edit', $params);
    }


    public function insertSemester(Request $request)
    {
        $inputs         = $request->input(); 
        $dataToInsert   = [
            'title'         => $inputs['title'],
            'code'          => $this->buildNextClassCode(),
            'timeStart'     =>  datepickerToTimestamp($inputs['timeStart']),
            'timeFinish'    =>  datepickerToTimestamp($inputs['timeFinish']),
            'isActive'      => 'false',
            'type'          => $inputs['type'],
        ];
       
        $insertedID = DB::table('semesters')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/semesters')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    
    public function updateSemester( Request $request, $semesterID )
    {
        $inputs         = $request->input(); 
        $dataToUpdate   = [
            'title'         => $inputs['title'],
            'timeStart'     => datepickerToTimestamp($inputs['timeStart']),
            'timeFinish'    => datepickerToTimestamp($inputs['timeFinish']),
            'type'          => $inputs['type'],
        ];
        
        $insertedID     = DB::table('semesters')->where('id',$semesterID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/semesters')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

        
    public function deleteSemester( $semesterID )
    {
        $affected = DB::table('semesters')
        ->where('id', '=' ,$semesterID)
        ->update([ 'trash' => trashed() ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

    public function activateSemester( $semesterID )
    {
        $affected = DB::table('semesters')
        ->update([ 'isActive' => 'false' ]);

        $affected = DB::table('semesters')
        ->where('id', '=' ,$semesterID)
        ->update([ 'isActive' => 'true' ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    private function buildNextClassCode()
    {

        $lastInsertedCode   = DB::table('semesters')->select('code')->where( 'trash', '<>', trashed() )->orderBy('code','desc')->get()->first()->code ?? 0;
        $lastInsertedCode++;
        return str_pad($lastInsertedCode, 7,"0", STR_PAD_LEFT);
    }


    
}
