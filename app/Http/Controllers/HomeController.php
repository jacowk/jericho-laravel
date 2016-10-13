<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	/*
    	select p.address_line_1, di.comments
			from diary_items di, users u, property_flips pf, properties p
				where di.allocated_user_id = u.id
				and di.property_flip_id = pf.id
				and pf.property_id = p.id
				and di.allocated_user_id = 1
				and di.followup_date = curdate()
				and di.status_id = 1;
    	*/
    	$user = Auth::user();
    	$todays_diary_items = DB::table('diary_items')
						->join('users', 'diary_items.allocated_user_id', '=', 'users.id')
						->join('property_flips', 'diary_items.property_flip_id', '=', 'property_flips.id')
						->join('properties', 'property_flips.property_id', '=', 'properties.id')
						->where('diary_items.allocated_user_id', '=', $user->id)
						->where('diary_items.followup_date', '=', date('Y-m-d'))
						->where('diary_items.status_id', '=', '1') /* ID for Open status */
						->select('diary_items.id',
								'diary_items.comments',
								'properties.address_line_1',
								'properties.address_line_2',
								'properties.address_line_3',
								'properties.address_line_4',
								'properties.address_line_5',
								'diary_items.created_at',
								'diary_items.followup_date')
						->get();
    	
		$open_diary_items = DB::table('diary_items')
						->join('users', 'diary_items.allocated_user_id', '=', 'users.id')
						->join('property_flips', 'diary_items.property_flip_id', '=', 'property_flips.id')
						->join('properties', 'property_flips.property_id', '=', 'properties.id')
						->where('diary_items.allocated_user_id', '=', $user->id)
						->where('diary_items.followup_date', '<', date('Y-m-d'))
						->where('diary_items.status_id', '=', '1') /* ID for Open status */
						->select('diary_items.id',
								'diary_items.comments',
								'properties.address_line_1',
								'properties.address_line_2',
								'properties.address_line_3',
								'properties.address_line_4',
								'properties.address_line_5',
								'diary_items.created_at',
								'diary_items.followup_date')
						->get();
        return view('home', [
        	'todays_diary_items' => $todays_diary_items,
        	'open_diary_items' => $open_diary_items
        ]);
    }
}
