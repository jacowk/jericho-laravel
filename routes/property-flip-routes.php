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
		Route::get('/link-estate-agent-contact', [
				'uses' => 'EstateAgentPropertyFlipController@postLinkContactEstateAgent',
				'as' => 'link-estate-agent-contact'
		]);
		
		Route::post('/link-estate-agent-contact', [
				'uses' => 'EstateAgentPropertyFlipController@postLinkContactEstateAgent',
				'as' => 'link-estate-agent-contact'
		]);
		
		Route::post('/do-link-estate-agent-contact', [
				'uses' => 'EstateAgentPropertyFlipController@postDoLinkContactEstateAgent',
				'as' => 'do-link-estate-agent-contact'
		]);
	});
	
	Route::get('/ajax-estate-agent-contacts', [
			'uses' => 'EstateAgentPropertyFlipController@postAjaxContactEstateAgents',
			'as' => 'ajax-estate-agent-contacts'
	]);
	
	Route::post('/do-link-estate-agent-contact-delete', [
			'uses' => 'EstateAgentPropertyFlipController@postDoLinkContactEstateAgentDelete',
			'as' => 'do-link-estate-agent-contact-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_ESTATE_AGENT_CONTACT_LINK);

	/* Link Contractors */
	Route::group(['middleware' => 'permission:' . PermissionConstants::LINK_CONTRACTOR_CONTACT], function() {
		Route::get('/link-contractor-contact', [
				'uses' => 'ContractorPropertyFlipController@postLinkContactContractor',
				'as' => 'link-contractor-contact'
		]);
		
		Route::post('/link-contractor-contact', [
				'uses' => 'ContractorPropertyFlipController@postLinkContactContractor',
				'as' => 'link-contractor-contact'
		]);
		
		Route::post('/do-link-contractor-contact', [
				'uses' => 'ContractorPropertyFlipController@postDoLinkContactContractor',
				'as' => 'do-link-contractor-contact'
		]);
	});
	
	Route::get('/ajax-contractor-contacts', [
			'uses' => 'ContractorPropertyFlipController@postAjaxContactContractors',
			'as' => 'ajax-contractor-contacts'
	]);
	
	Route::get('/ajax-contractor-contact-types', [
			'uses' => 'ContractorPropertyFlipController@postAjaxContactContractorTypes',
			'as' => 'ajax-contractor-contact-types'
	]);
	
	Route::post('/do-link-contractor-contact-delete', [
			'uses' => 'ContractorPropertyFlipController@postDoLinkContactContractorDelete',
			'as' => 'do-link-contractor-contact-delete'
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
		Route::get('/link-investor-contact', [
				'uses' => 'InvestorPropertyFlipController@postLinkContactInvestor',
				'as' => 'link-investor-contact'
		]);
	
		Route::post('/link-investor-contact', [
				'uses' => 'InvestorPropertyFlipController@postLinkContactInvestor',
				'as' => 'link-investor-contact'
		]);
	
		Route::post('/do-link-investor-contact', [
				'uses' => 'InvestorPropertyFlipController@postDoLinkContactInvestor',
				'as' => 'do-link-investor-contact'
		]);
	});
	
	Route::post('/do-link-investor-contact-delete', [
			'uses' => 'InvestorPropertyFlipController@postDoLinkContactInvestorDelete',
			'as' => 'do-link-investor-contact-delete'
	])->middleware('auth', 'permission:' . PermissionConstants::DELETE_INVESTOR_CONTACT_LINK);

});