<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $params = [
            'categories' => DB::table('categories')->select('*')->where('trash', '<>', trashed())->get()->toArray(),
        ];

        return view('pages.categories.index', $params);
    }


    public function addCategory()
    {
        return view('pages.categories.add');
    }



    public function editCategory( $categoryID )
    {
        $params = [
            'category' => DB::table('categories')->select('*')->where([ [ 'trash', '<>', trashed() ], [ 'id', '=', $categoryID ] ])->get()->first(),
        ];
        return view('pages.categories.edit', $params);
    }


    public function insertCategory(Request $request)
    {
        $inputs         = $request->input(); 
        $dataToInsert   = [
            'title'         => $inputs['title'],
        ];
       
        $insertedID = DB::table('categories')->insertGetId($dataToInsert);

        if( $insertedID )
            return redirect('/categories')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }


    
    public function updateCategory( Request $request, $categoryID )
    {
        $inputs         = $request->input(); 
        $dataToUpdate   = [
            'title'         => $inputs['title'],
        ];
       
        $insertedID     = DB::table('categories')->where('id',$categoryID)->update($dataToUpdate);

        if( $insertedID )
            return redirect('/categories')->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }

        
    public function deleteCategory( $categoryID )
    {
        $affected = DB::table('categories')
        ->where('id', '=' ,$categoryID)
        ->update([ 'trash' => trashed() ]);

        if( $affected )
            return back()->with('flashMessage', messageErrors( 200 ) );
        else
            return back()->with('flashMessage',messageErrors( 402 ) );
    }
}
