<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;

use jericho\Http\Requests;
use jericho\Area;

class TestController extends Controller
{
    public function getTest()
    {
    	return view('test.test');
    }
    
    public function postTest(Request $request)
    {
    	$area = $request->area;
    	echo "Area: " . $area . "<br>";
    	$areas = Area::where('name', 'like', $area . '%')
    				->orderBy('name', 'asc')->get();
    	echo "Areas retrieved: " . count($areas);
    	
    	foreach($areas as $area)
    	{
    		echo "Area: " . $area . "<br>";
    	}
    	return view('test.test', ['areas' => $areas]);
    }
}
