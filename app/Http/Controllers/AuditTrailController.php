<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use jericho\Http\Requests;
use OwenIt\Auditing\Facades\Auditing;
use jericho\Util\LookupUtil;
use jericho\Util\Util;
use DB;

/**
 * This controller is for performing searches on audits
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-12
 *
 */
class AuditTrailController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchAuditTrail()
	{
		$users = LookupUtil::retrieveUsersLookup();
		/* Search criteria */
		$user_id = "-1";
		$from_date = null;
		$to_date = null;
		return view('audit-trail.search-audit-trail', [
			'users' => $users,
			'user_id' => $user_id,
			'from_date' => $from_date,
			'to_date' => $to_date
		]);
	}
	
	/**
	 * Search for audits
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchAuditTrail(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'user_id' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('search-audit-trail')
				->withErrors($validator)
				->withInput();
		}
		$user_id = -1;
		$from_date = null;
		$to_date = null;
		if (Util::isValidRequestVariable($request->user_id) && $request->user_id > 0)
		{
			$user_id = $request->user_id;
			$where_clause = array();
			$where_clause['audits.user_id'] = $user_id;
			if (Util::isValidRequestVariable($request->from_date) && Util::isValidRequestVariable($request->to_date))
			{
				$from_date = $request->from_date;
				$to_date = $request->to_date;
				$audits = DB::table('audits')
						->join('users', 'audits.user_id', '=', 'users.id')
						->where('audits.user_id', '=', $user_id)
						->whereBetween('audits.created_at', [$from_date, $to_date])
						->select('audits.created_at',
								'users.firstname',
								'users.surname',
								'audits.ip_address',
								'audits.type',
								'audits.auditable_type',
								'audits.auditable_id',
								'audits.old',
								'audits.new')
						->get();
			}
			else
			{
				$audits = DB::table('audits')
						->join('users', 'audits.user_id', '=', 'users.id')
						->where('audits.user_id', '=', $user_id)
						->select('audits.created_at', 
								'users.firstname', 
								'users.surname',
								'audits.ip_address',
								'audits.type',
								'audits.auditable_type',
								'audits.auditable_id',
								'audits.old',
								'audits.new')
						->get();
			}
		}
		else
		{
			$audits = DB::table('audits')
				->join('users', 'audits.user_id', '=', 'users.id')
				->select('audits.created_at', 
						'users.firstname', 
						'users.surname',
						'audits.ip_address',
						'audits.type',
						'audits.auditable_type',
						'audits.auditable_id',
						'audits.old',
						'audits.new')
				->get();
		}
		$users = LookupUtil::retrieveUsersLookup();
		return view('audit-trail.search-audit-trail', [
			'audits' => $audits,
			'users' => $users,
			'user_id' => $user_id,
			'from_date' => $from_date,
			'to_date' => $to_date
		]);
	}
}
