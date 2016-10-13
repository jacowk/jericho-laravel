<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\Note;
use jericho\PropertyFlip;
use jericho\Util\Util;
use jericho\Util\TabConstants;

/**
 * This class is a controller for performing CRUD operations on notes
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-20
 *
 */
class NoteController extends Controller
{
	/**
	 * Load page to add an note
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddNote(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::NOTES_TAB);
		return view('note.add-note', [
			'property_flip_id' => $property_flip_id
		]);
	}
	
	/**
	 * Add an note
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddNote(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::NOTES_TAB);
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-note', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$note = new Note();
		$note->description = Util::getQueryParameter($request->description);
		$note->created_by_id = $user->id;
		
		$property_flip = PropertyFlip::find($request->property_flip_id);
		$property_flip->notes()->save($note);
		
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $property_flip->id])
			->with(['message' => 'Note added']);
	}
	
	/**
	 * Load page to update an note
	 *
	 * @param Request $request
	 * @param unknown $note_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateNote(Request $request, $note_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::NOTES_TAB);
		$note = Note::find($note_id);
		return view('note.update-note', ['note' => $note]);
	}
	
	/**
	 * Update an note
	 *
	 * @param Request $request
	 * @param unknown $note_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateNote(Request $request, $note_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::NOTES_TAB);
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-note', ['note_id' => $note_id ])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		$note = Note::find($note_id);
		$note->description = Util::getQueryParameter($request->description);
		$note->updated_by_id = $user->id;
		$note->save();
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $note->property_flip->id])
			->with(['message' => 'Note updated']);
	}
	
	/**
	 * Load the page to view an note
	 *
	 * @param Request $request
	 * @param unknown $note_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewNote(Request $request, $note_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::NOTES_TAB);
		$note = Note::find($note_id);
		return view('note.view-note', [
				'note' => $note
		]);
	}
}
