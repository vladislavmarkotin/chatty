<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 06.09.2017
 * Time: 6:38
 */

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Collection;

class SearchController extends Controller
{
    public function getResults(Request $request)
    {
        $query = $request->input('search');

        //dd($query);
        if(!$query){
            return redirect()->route('home');
        }

        $users = User::where(DB::raw( "CONCAT(first_name, ' ', last_name)" ),
                "LIKE", "%{$query}%" )
            ->orWhere('first_name', 'LIKE', "%{$query}%")
            ->get();
            //dd($users);


        return view('search.results')->with('users', $users);
    }
} 