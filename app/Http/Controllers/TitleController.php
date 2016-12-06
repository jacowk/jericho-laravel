<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupTitle;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Validation\UpdateObjectValidator;
use jericho\Validation\ViewObjectValidator;

/**
 * This class is a controller for performing CRUD operations on titles
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-23
 *
 */
class TitleController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchTitle()
	{
		return view('title.search-title', [
				'description' => null
		]);
	}
	
	/**
	 * Search for titles
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchTitle(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$titles = LookupTitle::where('description', 'like', '%' . $description . '%')
							->orderBy('description', 'asc')
							->paginate($user->pagination_size);
		}
		else
		{
			$titles = LookupTitle::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('title.search-title', [
				'titles' => $titles,
				'description' => $description
		]);
	}
	
	/**
	 * Load page to add an title
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddTitle()
	{
		return view('title.add-title');
	}
	
	/**
	 * Add a title
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddTitle(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_titles'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-title')
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$title = new LookupTitle();
		$title->description = Util::getQueryParameter($request->description);
		$title->created_by_id = $user->id;
		$title->save();
		return redirect()->action('TitleController@getViewTitle', ['title_Id' => $title->id])
			->with(['message' => 'Title saved']);
	}
	
	/**
	 * Load page to update a title
	 *
	 * @param Request $request
	 * @param unknown $title_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateTitle(Request $request, $title_id)
	{
		$title = LookupTitle::find($title_id);
		(new UpdateObjectValidator())->validate($title, 'title', $title_id);
		return view('title.update-title', ['title' => $title]);
	}
	
	/**
	 * Update an title
	 *
	 * @param Request $request
	 * @param unknown $title_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateTitle(Request $request, $title_id)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-title', ['title_id' => $title_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$title = LookupTitle::find($title_id);
		(new UpdateObjectValidator())->validate($title, 'title', $title_id);
		$title->description = Util::getQueryParameter($request->description);
		$title->updated_by_id = $user->id;
		$title->save();
		return redirect()->action('TitleController@getViewTitle', ['title_Id' => $title->id])
		->with(['message' => 'Title updated']);
	}
	
	/**
	 * Load the page to view an title
	 *
	 * @param Request $request
	 * @param unknown $title_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewTitle(Request $request, $title_id)
	{
		$title = LookupTitle::find($title_id);
		(new ViewObjectValidator())->validate($title, 'title', $title_id);
		return view('title.view-title', [
				'title' => $title
		]);
	}
}
