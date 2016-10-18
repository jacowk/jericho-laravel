<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use jericho\Http\Requests;
use jericho\Document;
use jericho\PropertyFlip;
use jericho\Util\Util;
use jericho\Util\TabConstants;
use jericho\Util\LookupUtil;

/**
 * This class is a controller for performing CRUD operations on documents
 *
 * @author Jaco Koekemoer
 * Date: 2016-09-21
 *
 */
class DocumentController extends Controller
{
	/**
	 * Load page to add an document
	 *
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getAddDocument(Request $request, $property_flip_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DOCUMENTS_TAB);
		$document_types = LookupUtil::retrieveLookupDocumentTypes();
		return view('document.add-document', [
			'property_flip_id' => $property_flip_id,
			'document_types' => $document_types
		]);
	}
	
	/**
	 * Add an document
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoAddDocument(Request $request)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DOCUMENTS_TAB);
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		
		$validator = Validator::make($request->all(), [
				'document_type_id' => 'required|not_in:-1',
				'uploaded_file' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('add-document', ['property_flip_id' => $request->property_flip_id])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		
		if ($request->hasFile('uploaded_file'))
		{
			/* Get request variables */
			$file = $request->file('uploaded_file');
			$file_size = $request->file('uploaded_file')->getSize();
			$client_original_name = $request->file('uploaded_file')->getClientOriginalName();
			$client_original_extension = $request->file('uploaded_file')->getClientOriginalExtension();
			$generated_filename = Util::generateFilename($user->id, $client_original_extension);
			$mime_type = $request->file('uploaded_file')->getClientMimeType();
			$real_path = $request->file('uploaded_file')->getRealPath();
			$property_flip_id = $request->property_flip_id;
			
			/* Upload file */
			$generated_path = Storage::putFileAs('documents', new File($real_path), $generated_filename);
			
			/* Create and save document */
			$document = new Document();
			$document->description = Util::getQueryParameter($request->description);
			$document->file_size = $file_size;
			$document->client_original_name = $client_original_name;
			$document->client_original_extension = $client_original_extension;
			$document->generated_filename = $generated_filename;
			$document->mime_type = $mime_type;
			$document->file = $file;
			$document->created_by_id = $user->id;
			$property_flip = PropertyFlip::find($property_flip_id);
			$property_flip->documents()->save($document);
		}
		
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $property_flip_id])
			->with(['message' => 'Document added']);
	}
	
	/**
	 * Load page to update an document
	 *
	 * @param Request $request
	 * @param unknown $document_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getUpdateDocument(Request $request, $document_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DOCUMENTS_TAB);
		$document_types = LookupUtil::retrieveLookupDocumentTypes();
		$document = Document::find($document_id);
		return view('document.update-document', [
			'document' => $document,
			'document_types' => $document_types
		]);
	}
	
	/**
	 * Update an document
	 *
	 * @param Request $request
	 * @param unknown $document_id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postDoUpdateDocument(Request $request, $document_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DOCUMENTS_TAB);
// 		$this->validate($request, [
// 				'description' => 'required'
// 		]);
		$validator = Validator::make($request->all(), [
				'document_type_id' => 'required|not_in:-1',
				'uploaded_file' => 'required'
		]);
		
		if ($validator->fails()) {
			return redirect()
				->route('update-document', ['document_id' => $document_id ])
				->withErrors($validator)
				->withInput();
		}
		$user = Auth::user();
		if ($request->hasFile('uploaded_file'))
		{
// 			$generated_filename = Util::generateFilename($user->id, $request->file('uploaded_file')->getClientOriginalExtension());
// 			$generated_path = Storage::putFileAs('documents',
// 				new File($request->file('uploaded_file')->getRealPath()), $generated_filename);
// 			$document = Document::find($document_id);
// 			$document->description = Util::getQueryParameter($request->description);
// 			$document->file_size = $request->file('uploaded_file')->getSize();
// 			$document->client_original_name = $request->file('uploaded_file')->getClientOriginalName();
// 			$document->client_original_extension = $request->file('uploaded_file')->getClientOriginalExtension();
// 			$document->generated_filename = $generated_path;
// 			$document->mime_type = $request->file('uploaded_file')->getClientMimeType();
// 			$document->file = $request->file('uploaded_file');

			/* Get request variables */
			$file = $request->file('uploaded_file');
			$file_size = $request->file('uploaded_file')->getSize();
			$client_original_name = $request->file('uploaded_file')->getClientOriginalName();
			$client_original_extension = $request->file('uploaded_file')->getClientOriginalExtension();
			$generated_filename = Util::generateFilename($user->id, $client_original_extension);
			$mime_type = $request->file('uploaded_file')->getClientMimeType();
			$real_path = $request->file('uploaded_file')->getRealPath();
			$property_flip_id = $request->property_flip_id;
			
			/* Upload file */
			$generated_path = Storage::putFileAs('documents', new File($real_path), $generated_filename);
			
			/* Create and save document */
			$document = new Document();
			$document->description = Util::getQueryParameter($request->description);
			$document->document_type_id = Util::getNumericQueryParameter($request->document_type_id);
			$document->file_size = $file_size;
			$document->client_original_name = $client_original_name;
			$document->client_original_extension = $client_original_extension;
			$document->generated_filename = $generated_filename;
			$document->mime_type = $mime_type;
			$document->file = $file;
			$document->updated_by_id = $user->id;
			$document->save();
		}
		return redirect()->action('PropertyFlipController@getViewPropertyFlip', ['property_flip_id' => $request->property_flip_id])
			->with(['message' => 'Document updated']);
	}
	
	/**
	 * Load the page to view an document
	 *
	 * @param Request $request
	 * @param unknown $document_id
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function getViewDocument(Request $request, $document_id)
	{
		$request->session()->set(TabConstants::ACTIVE_TAB, TabConstants::DOCUMENTS_TAB);
		$document = Document::find($document_id);
		$direct_url = Storage::url('app/' . $document->generated_filename);
		return view('document.view-document', [
				'document' => $document,
				'direct_url' => $direct_url
		]);
	}
	
	/**
	 * Download the document from the database
	 * 
	 * @param Request $request
	 * @param unknown $document_id
	 */
	public function downloadDocument(Request $request, $document_id)
	{
		$document = Document::find($document_id);
		return response($document->file)
			->withHeaders([
				'Content-Type' => $document->client_original_extension,
				'Content-Length' => $document->filesize,
				'Content-Disposition' => 'attachment; filename=' . $document->generated_filename
			]);
	}
	
	/**
	 * Download the document from the file system
	 * 
	 * @param Request $request
	 * @param unknown $document_id
	 * @return \Illuminate\Http\Response
	 */
	public function downloadDocumentDirect(Request $request, $document_id)
	{
		$document = Document::find($document_id);
		$filename = 'documents/' . $document->generated_filename;
		$file = Storage::disk('local')->get($filename);
		return (new Response($file, 200))
			->withHeaders([
				'Content-Type' => $document->mime,
				'Content-Length' => $document->file_size,
				'Content-Disposition' => 'attachment; filename=' . $filename
			]);
	}
}
