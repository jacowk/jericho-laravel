<?php
/* ****************************** Property Flip Routes ****************************** */

/* Search Property Flips */
Route::get('/search-property-flip', [
		'uses' => 'PropertyFlipController@getSearchPropertyFlip',
		'as' => 'search-property-flip'
])->middleware('auth', 'permission:VIEW_PROPERTY_FLIP');

Route::post('/search-property-flip', [
		'uses' => 'PropertyFlipController@getSearchPropertyFlip',
		'as' => 'search-property-flip'
])->middleware('auth', 'permission:VIEW_PROPERTY_FLIP');

Route::post('/do-search-property-flip', [
		'uses' => 'PropertyFlipController@postDoSearchPropertyFlip',
		'as' => 'do-search-property-flip'
])->middleware('auth', 'permission:VIEW_PROPERTY_FLIP');

/* Add an Property Flip */
Route::post('/add-property-flip/{property_id}', [
		'uses' => 'PropertyFlipController@getAddPropertyFlip',
		'as' => 'add-property-flip'
])->middleware('auth', 'permission:ADD_PROPERTY_FLIP');

Route::post('/do-add-property-flip', [
		'uses' => 'PropertyFlipController@postDoAddPropertyFlip',
		'as' => 'do-add-property-flip'
])->middleware('auth', 'permission:ADD_PROPERTY_FLIP');

/* Update an Property Flip */
Route::get('/update-property-flip/{property_flip_id}', [
		'uses' => 'PropertyFlipController@getUpdatePropertyFlip',
		'as' => 'update-property-flip'
])->middleware('auth', 'permission:UPDATE_PROPERTY_FLIP');

Route::post('/update-property-flip/{property_flip_id}', [
		'uses' => 'PropertyFlipController@getUpdatePropertyFlip',
		'as' => 'update-property-flip'
])->middleware('auth', 'permission:UPDATE_PROPERTY_FLIP');

Route::post('/do-update-property-flip/{property_flip_id}', [
		'uses' => 'PropertyFlipController@postDoUpdatePropertyFlip',
		'as' => 'do-update-property-flip'
])->middleware('auth', 'permission:UPDATE_PROPERTY_FLIP');

/* View Property Flip */
Route::get('/view-property-flip/{property_flip_id}', [
		'uses' => 'PropertyFlipController@getViewPropertyFlip',
		'as' => 'view-property-flip'
])->middleware('auth', 'permission:VIEW_PROPERTY_FLIP');;

Route::post('/view-property-flip/{property_flip_id}', [
		'uses' => 'PropertyFlipController@getViewPropertyFlip',
		'as' => 'view-property-flip'
])->middleware('auth', 'permission:VIEW_PROPERTY_FLIP');

/* Link Attoneys */
Route::get('/link-attorney-contact', [
		'uses' => 'AttorneyPropertyFlipController@postLinkAttorneyContact',
		'as' => 'link-attorney-contact'
])->middleware('auth', 'permission:LINK_ATTORNEY_CONTACT');

Route::post('/link-attorney-contact', [
		'uses' => 'AttorneyPropertyFlipController@postLinkAttorneyContact',
		'as' => 'link-attorney-contact'
])->middleware('auth', 'permission:LINK_ATTORNEY_CONTACT');

Route::post('/do-link-attorney-contact', [
		'uses' => 'AttorneyPropertyFlipController@postDoLinkAttorneyContact',
		'as' => 'do-link-attorney-contact'
])->middleware('auth', 'permission:LINK_ATTORNEY_CONTACT');

Route::get('/ajax-attorney-contacts', [
		'uses' => 'AttorneyPropertyFlipController@postAjaxAttorneyContacts',
		'as' => 'ajax-attorney-contacts'
]);

Route::post('/do-link-attorney-contact-delete', [
		'uses' => 'AttorneyPropertyFlipController@postDoLinkAttorneyContactDelete',
		'as' => 'do-link-attorney-contact-delete'
])->middleware('auth', 'permission:DELETE_ATTORNEY_CONTACT_LINK');

/* Link Estate Agents */
Route::get('/link-contact-estate-agent', [
		'uses' => 'EstateAgentPropertyFlipController@postLinkContactEstateAgent',
		'as' => 'link-contact-estate-agent'
])->middleware('auth', 'permission:LINK_ESTATE_AGENT_CONTACT');

Route::post('/link-contact-estate-agent', [
		'uses' => 'EstateAgentPropertyFlipController@postLinkContactEstateAgent',
		'as' => 'link-contact-estate-agent'
])->middleware('auth', 'permission:LINK_ESTATE_AGENT_CONTACT');

Route::post('/do-link-contact-estate-agent', [
		'uses' => 'EstateAgentPropertyFlipController@postDoLinkContactEstateAgent',
		'as' => 'do-link-contact-estate-agent'
])->middleware('auth', 'permission:LINK_ESTATE_AGENT_CONTACT');

Route::get('/ajax-contact-estate-agents', [
		'uses' => 'EstateAgentPropertyFlipController@postAjaxContactEstateAgents',
		'as' => 'ajax-contact-estate-agents'
]);

Route::post('/do-link-contact-estate-agent-delete', [
		'uses' => 'EstateAgentPropertyFlipController@postDoLinkContactEstateAgentDelete',
		'as' => 'do-link-contact-estate-agent-delete'
])->middleware('auth', 'permission:DELETE_ESTATE_AGENT_CONTACT_LINK');

/* Link Contractors */
Route::get('/link-contact-contractor', [
		'uses' => 'ContractorPropertyFlipController@postLinkContactContractor',
		'as' => 'link-contact-contractor'
])->middleware('auth', 'permission:LINK_CONTRACTOR_CONTACT');

Route::post('/link-contact-contractor', [
		'uses' => 'ContractorPropertyFlipController@postLinkContactContractor',
		'as' => 'link-contact-contractor'
])->middleware('auth', 'permission:LINK_CONTRACTOR_CONTACT');

Route::post('/do-link-contact-contractor', [
		'uses' => 'ContractorPropertyFlipController@postDoLinkContactContractor',
		'as' => 'do-link-contact-contractor'
])->middleware('auth', 'permission:LINK_CONTRACTOR_CONTACT');

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
])->middleware('auth', 'permission:DELETE_CONTRACTOR_CONTACT_LINK');

/* Link Banks */
Route::get('/link-bank-contact', [
		'uses' => 'BankPropertyFlipController@postLinkBankContact',
		'as' => 'link-bank-contact'
])->middleware('auth', 'permission:LINK_BANK_CONTACT');

Route::post('/link-bank-contact', [
		'uses' => 'BankPropertyFlipController@postLinkBankContact',
		'as' => 'link-bank-contact'
])->middleware('auth', 'permission:LINK_BANK_CONTACT');

Route::post('/do-link-bank-contact', [
		'uses' => 'BankPropertyFlipController@postDoLinkBankContact',
		'as' => 'do-link-bank-contact'
])->middleware('auth', 'permission:LINK_BANK_CONTACT');

Route::get('/ajax-bank-contacts', [
		'uses' => 'BankPropertyFlipController@postAjaxBankContacts',
		'as' => 'ajax-bank-contacts'
]);

Route::post('/do-link-bank-contact-delete', [
		'uses' => 'BankPropertyFlipController@postDoLinkBankContactDelete',
		'as' => 'do-link-bank-contact-delete'
])->middleware('auth', 'permission:DELETE_BANK_CONTACT_LINK');