<?php
/* ****************************** Property Flip Routes ****************************** */

Route::group(['middleware' => 'auth'], function() {

	Route::group(['middleware' => 'permission:' . PermissionConstants::VIEW_PROPERTY_FLIP], function() {

		/* Search Property Flips */
		Route::get('/search-property-flip', [
				'uses' => 'PropertyFlipController@getSearchPropertyFlip',
				'as' => 'search-property-flip'
		]);
		
		Route::post('/search-property-flip', [
				'uses' => 'PropertyFlipController@getSearchPropertyFlip',
				'as' => 'search-property-flip'
		]);
		
		Route::post('/do-search-property-flip', [
				'uses' => 'PropertyFlipController@postDoSearchPropertyFlip',
				'as' => 'do-search-property-flip'
		]);
		
		/* View Property Flip */
		Route::get('/view-property-flip/{property_flip_id}', [
				'uses' => 'PropertyFlipController@getViewPropertyFlip',
				'as' => 'view-property-flip'
		]);;
		
		Route::post('/view-property-flip/{property_flip_id}', [
				'uses' => 'PropertyFlipController@getViewPropertyFlip',
				'as' => 'view-property-flip'
		]);
		
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::ADD_PROPERTY_FLIP], function() {
		/* Add an Property Flip */
		Route::post('/add-property-flip/{property_id}', [
				'uses' => 'PropertyFlipController@getAddPropertyFlip',
				'as' => 'add-property-flip'
		]);
		
		Route::get('/add-property-flip/{property_id}', [
				'uses' => 'PropertyFlipController@getAddPropertyFlip',
				'as' => 'add-property-flip'
		]);
		
		Route::post('/do-add-property-flip', [
				'uses' => 'PropertyFlipController@postDoAddPropertyFlip',
				'as' => 'do-add-property-flip'
		]);
	});

	Route::group(['middleware' => 'permission:' . PermissionConstants::UPDATE_PROPERTY_FLIP], function() {
		/* Update an Property Flip */
		Route::get('/update-property-flip/{property_flip_id}', [
				'uses' => 'PropertyFlipController@getUpdatePropertyFlip',
				'as' => 'update-property-flip'
		]);
		
		Route::post('/update-property-flip/{property_flip_id}', [
				'uses' => 'PropertyFlipController@getUpdatePropertyFlip',
				'as' => 'update-property-flip'
		]);
		
		Route::post('/do-update-property-flip/{property_flip_id}', [
				'uses' => 'PropertyFlipController@postDoUpdatePropertyFlip',
				'as' => 'do-update-property-flip'
		]);
	});

	/* Link Attoneys */
	Route::group(['middleware' => 'permission:' . PermissionConstants::LINK_ATTORNEY_CONTACT], function() {
		Route::get('/link-attorney-contact', [
				'uses' => 'AttorneyPropertyFlipController@postLinkAttorneyContact',
				'as' => 'link-attorney-contact'
		]);
		
		Route::post('/link-attorney-contact', [
				'uses' => 'AttorneyPropertyFlipController@postLinkAttorneyContact',
				'as' => 'link-attorney-contact'
		]);
		
		Route::post('/do-link-attorney-contact', [
				'uses' => 'AttorneyPropertyFlipController@postDoLinkAttorneyContact',
				'as' => 'do-link-attorney-contact'
		]);
	});
	
	Route::get('/ajax-attorney-contacts', [
			'uses' => 'AttorneyPropertyFlipController@postAjaxAttorneyContacts',
			'as' => 'ajax-attorney-contacts'
	]);
	
	Route::post('/do-link-attorney-contact-delete', [
			'uses' => 'AttorneyPropertyFlipController@postDoLinkAttorneyContactDelete',
			'as' => 'do-link-attorney-contact-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_ATTORNEY_CONTACT_LINK);

	/* Link Estate Agents */
	Route::group(['middleware' => 'permission:' . PermissionConstants::LINK_ESTATE_AGENT_CONTACT], function() {
		Route::get('/link-contact-estate-agent', [
				'uses' => 'EstateAgentPropertyFlipController@postLinkContactEstateAgent',
				'as' => 'link-contact-estate-agent'
		]);
		
		Route::post('/link-contact-estate-agent', [
				'uses' => 'EstateAgentPropertyFlipController@postLinkContactEstateAgent',
				'as' => 'link-contact-estate-agent'
		]);
		
		Route::post('/do-link-contact-estate-agent', [
				'uses' => 'EstateAgentPropertyFlipController@postDoLinkContactEstateAgent',
				'as' => 'do-link-contact-estate-agent'
		]);
	});
	
	Route::get('/ajax-contact-estate-agents', [
			'uses' => 'EstateAgentPropertyFlipController@postAjaxContactEstateAgents',
			'as' => 'ajax-contact-estate-agents'
	]);
	
	Route::post('/do-link-contact-estate-agent-delete', [
			'uses' => 'EstateAgentPropertyFlipController@postDoLinkContactEstateAgentDelete',
			'as' => 'do-link-contact-estate-agent-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_ESTATE_AGENT_CONTACT_LINK);

	/* Link Contractors */
	Route::group(['middleware' => 'permission:' . PermissionConstants::LINK_CONTRACTOR_CONTACT], function() {
		Route::get('/link-contact-contractor', [
				'uses' => 'ContractorPropertyFlipController@postLinkContactContractor',
				'as' => 'link-contact-contractor'
		]);
		
		Route::post('/link-contact-contractor', [
				'uses' => 'ContractorPropertyFlipController@postLinkContactContractor',
				'as' => 'link-contact-contractor'
		]);
		
		Route::post('/do-link-contact-contractor', [
				'uses' => 'ContractorPropertyFlipController@postDoLinkContactContractor',
				'as' => 'do-link-contact-contractor'
		]);
	});
	
	Route::get('/ajax-contact-contractors', [
			'uses' => 'ContractorPropertyFlipController@postAjaxContactContractors',
			'as' => 'ajax-contact-contractors'
	]);
	
	Route::get('/ajax-contact-contractor-types', [
			'uses' => 'ContractorPropertyFlipController@postAjaxContactContractorTypes',
			'as' => 'ajax-contact-contractor-types'
	]);
	
	Route::post('/do-link-contact-contractor-delete', [
			'uses' => 'ContractorPropertyFlipController@postDoLinkContactContractorDelete',
			'as' => 'do-link-contact-contractor-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_CONTRACTOR_CONTACT_LINK);

	/* Link Banks */
	Route::group(['middleware' => 'permission:' . PermissionConstants::LINK_BANK_CONTACT], function() {
		Route::get('/link-bank-contact', [
				'uses' => 'BankPropertyFlipController@postLinkBankContact',
				'as' => 'link-bank-contact'
		]);
		
		Route::post('/link-bank-contact', [
				'uses' => 'BankPropertyFlipController@postLinkBankContact',
				'as' => 'link-bank-contact'
		]);
		
		Route::post('/do-link-bank-contact', [
				'uses' => 'BankPropertyFlipController@postDoLinkBankContact',
				'as' => 'do-link-bank-contact'
		]);
	});
	
	Route::get('/ajax-bank-contacts', [
			'uses' => 'BankPropertyFlipController@postAjaxBankContacts',
			'as' => 'ajax-bank-contacts'
	]);
	
	Route::post('/do-link-bank-contact-delete', [
			'uses' => 'BankPropertyFlipController@postDoLinkBankContactDelete',
			'as' => 'do-link-bank-contact-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_BANK_CONTACT_LINK);
	
	/* Link Investors */
	Route::group(['middleware' => 'permission:' . PermissionConstants::LINK_INVESTOR_CONTACT], function() {
		Route::get('/link-contact-investor', [
				'uses' => 'InvestorPropertyFlipController@postLinkContactInvestor',
				'as' => 'link-contact-investor'
		]);
	
		Route::post('/link-contact-investor', [
				'uses' => 'InvestorPropertyFlipController@postLinkContactInvestor',
				'as' => 'link-contact-investor'
		]);
	
		Route::post('/do-link-contact-investor', [
				'uses' => 'InvestorPropertyFlipController@postDoLinkContactInvestor',
				'as' => 'do-link-contact-investor'
		]);
	});
	
	Route::post('/do-link-contact-investor-delete', [
			'uses' => 'InvestorPropertyFlipController@postDoLinkContactInvestorDelete',
			'as' => 'do-link-contact-investor-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_INVESTOR_CONTACT_LINK);

});