<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function gameMaster(Request $request){
    	return view('mastergame');
    }
}
