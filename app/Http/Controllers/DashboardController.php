<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
                    'coursesCount' => DB::table('courses')->where([ [ 'trash', '<>', trashed() ] ])->count(),
                ],
            'systemStatics' => 
                [
                    'totalDisk'     => $totalDisk,   
                    'usedDisk'      => $usedDisk,   
                    'freeDisk'      => $freeDisk,   
                    'usedPercent'   => round( ( $usedDisk / $totalDisk ) * 100 ),   
                ]
        ];
        return view('pages.dashboard.index', $params);
    }
}
