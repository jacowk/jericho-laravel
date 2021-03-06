<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use jericho\Http\Requests;
use OwenIt\Auditing\Facades\Auditing;
use jericho\Util\Util;
use jericho\Lookup\UserLookupRetriever;
use DB;
use DateTime;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

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
		$users = (new UserLookupRetriever())->execute();
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
		/* TODO request variables of the search criteria are lost */
		
// 		$validator = Validator::make($request->all(), [
// 				'user_id' => 'required|not_in:-1',
// 				'from_date' => 'date',
// 				'to_date' => 'date'
// 		]);
		
// 		if ($validator->fails()) {
// 			return redirect()
// 				->route('search-audit-trail')
// 				->withErrors($validator)
// 				->withInput();
// 		}
		$user_id = null;
		$from_date = null;
		$to_date = null;
		$query_parameters = array();
		$user_id_query_parameter = null;
		$from_date_query_parameter = null;
		$to_date_query_parameter = null;
		
		/* User ID */
		if (Util::isValidSelectRequestVariable($request->user_id))
		{
			$user_id = $request->user_id;
			$user_id_query_parameter = ['audits.user_id', '=', $user_id];
			array_push($query_parameters, $user_id_query_parameter);
		}
		
		/* From Date */
		if (Util::isValidRequestVariable($request->from_date))
		{
			$from_date = $request->from_date;
			$from_date_query_parameter = $from_date;
		}
		else
		{
			$from_date_query_parameter = DateTime::createFromFormat('Y-m-d H:i:s', '1970-01-01 00:00:00');
		}
		
		/* To Date */
		if (Util::isValidRequestVariable($request->to_date))
		{
			$to_date = $request->to_date;
			$to_date_query_parameter = $to_date;
		}
		else
		{
			$to_date_query_parameter = DateTime::createFromFormat('Y-m-d H:i:s', '2100-12-31 23:59:59');
		}
		
		$user = (new AuthUserRetriever())->retrieveUser();
		if (Util::isValidSelectRequestVariable($request->user_id))
		{
			$audits = DB::table('audits')
					->leftJoin('users', 'audits.user_id', '=', 'users.id')
					->where($query_parameters)
					->whereBetween('audits.created_at', [$from_date_query_parameter, $to_date_query_parameter])
					->select('audits.created_at',
							'users.firstname',
							'users.surname',
							'audits.ip_address',
							'audits.type',
							'audits.auditable_type',
							'audits.auditable_id',
							'audits.old',
							'audits.new')
					->orderBy('audits.created_at', 'desc')
					->paginate($user->pagination_size);
		}
		else
		{
			$audits = DB::table('audits')
					->leftJoin('users', 'audits.user_id', '=', 'users.id')
					->whereBetween('audits.created_at', [$from_date_query_parameter, $to_date_query_parameter])
					->select('audits.created_at',
							'users.firstname',
							'users.surname',
							'audits.ip_address',
							'audits.type',
							'audits.auditable_type',
							'audits.auditable_id',
							'audits.old',
							'audits.new')
					->orderBy('audits.created_at', 'desc')
					->paginate($user->pagination_size);
		}
		
		$users = (new UserLookupRetriever())->execute();
		return view('audit-trail.search-audit-trail', [
			'audits' => $audits,
			'users' => $users,
			'user_id' => $user_id,
			'from_date' => $from_date,
			'to_date' => $to_date
		]);
	}
}
