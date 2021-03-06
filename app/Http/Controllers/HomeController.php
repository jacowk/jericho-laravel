<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use DateTime;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

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
    	$user = (new AuthUserRetriever())->retrieveUser();
    	$this_morning = new DateTime('today');
    	$tomorrow_morning = new DateTime('tomorrow');
    	
    	$todays_diary_items = DB::table('diary_items')
						->leftJoin('property_flips', 'diary_items.property_flip_id', '=', 'property_flips.id')
						->leftJoin('properties', 'property_flips.property_id', '=', 'properties.id')
						->leftJoin('users', 'diary_items.followup_user_id', '=', 'users.id')
						->where('diary_items.followup_user_id', '=', $user->id)
// 						->where('diary_items.followup_date', '=', date('Y-m-d'))
						->whereBetween('diary_items.followup_date', [$this_morning, $tomorrow_morning])
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
    	
		$past_diary_items = DB::table('diary_items')
						->leftJoin('property_flips', 'diary_items.property_flip_id', '=', 'property_flips.id')
						->leftJoin('properties', 'property_flips.property_id', '=', 'properties.id')
						->leftJoin('users', 'diary_items.followup_user_id', '=', 'users.id')
						->where('diary_items.followup_user_id', '=', $user->id)
						->where('diary_items.followup_date', '<', $this_morning)
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
		
		$future_diary_items = DB::table('diary_items')
						->leftJoin('property_flips', 'diary_items.property_flip_id', '=', 'property_flips.id')
						->leftJoin('properties', 'property_flips.property_id', '=', 'properties.id')
						->leftJoin('users', 'diary_items.followup_user_id', '=', 'users.id')
						->where('diary_items.followup_user_id', '=', $user->id)
						->where('diary_items.followup_date', '>', $tomorrow_morning)
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
        	'past_diary_items' => $past_diary_items,
        	'future_diary_items' => $future_diary_items,
        	'user' => $user
        ]);
    }
}
