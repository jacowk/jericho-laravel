<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use jericho\Http\Requests;
use jericho\LookupDocumentType;
use jericho\Util\Util;
use jericho\Http\Controllers\Auth\AuthUserRetriever;

/**
 * This class is a controller for performing CRUD operations on document types
 *
 * @author Jaco Koekemoer
 * Date: 2016-10-18
 *
 */
class DocumentTypeController extends Controller
{
	/**
	 * Load search page
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getSearchDocumentType()
	{
		return view('document-type.search-document-type', [
			'description' => null
		]);
	}
	
	/**
	 * Search for document type
	 *
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function postDoSearchDocumentType(Request $request)
	{
		$user = (new AuthUserRetriever())->retrieveUser();
		$description = null;
		if (Util::isValidRequestVariable($request->description))
		{
			$description = $request->description;
			$document_types = LookupDocumentType::where('description', 'like', '%' . $description . '%')
								->orderBy('description', 'asc')
								->paginate($user->pagination_size);
		}
		else
		{
			$document_types = LookupDocumentType::orderBy('description', 'asc')->paginate($user->pagination_size);
		}
		return view('document-type.search-document-type', [
			'document_types' => $document_types,
			'description' => $description
		]);
	}
	
	/**
	 * Load page to add an document type
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddDocumentType()
	{
		return view('document-type.add-document-type');
	}
	
	/**
	 * Add a document type
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddDocumentType(Request $request)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required|unique:lookup_document_types'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-document-type')
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$document_type = new LookupDocumentType();
		$document_type->description = Util::getQueryParameter($request->description);
		$document_type->created_by_id = $user->id;
		$document_type->save();
		return redirect()->action('DocumentTypeController@getViewDocumentType', ['document_type_Id' => $document_type->id])
			->with(['message' => 'Document Type saved']);
	}
	
	/**
	 * Load page to update a document type
	 *
	 * @param Request $request
	 * @param unknown $document_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateDocumentType(Request $request, $document_type_id)
	{
		$document_type = LookupDocumentType::find($document_type_id);
		return view('document-type.update-document-type', ['document_type' => $document_type]);
	}
	
	/**
	 * Update an document type
	 *
	 * @param Request $request
	 * @param unknown $document_type_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateDocumentType(Request $request, $document_type_id)
	{
		$validator = Validator::make($request->all(), [
				'description' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-document-type', ['document_type_id' => $document_type_id])
				->withErrors($validator)
				->withInput();
		}
		$user = (new AuthUserRetriever())->retrieveUser();
		$document_type = LookupDocumentType::find($document_type_id);
		$document_type->description = Util::getQueryParameter($request->description);
		$document_type->updated_by_id = $user->id;
		$document_type->save();
		return redirect()->action('DocumentTypeController@getViewDocumentType', ['document_type_Id' => $document_type->id])
		->with(['message' => 'Document Type updated']);
	}
	
	/**
	 * Load the page to view an document type
	 *
	 * @param Request $request
	 * @param unknown $document_type_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewDocumentType(Request $request, $document_type_id)
	{
		$document_type = LookupDocumentType::find($document_type_id);
		return view('document-type.view-document-type', [
				'document_type' => $document_type
		]);
	}
}
