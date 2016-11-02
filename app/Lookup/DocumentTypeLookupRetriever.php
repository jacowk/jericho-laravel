<?php
namespace jericho\Lookup;

use jericho\Component\Component;
use jericho\LookupDocumentType;

/**
 * A component for retrieving document types to be used in a dropdown box in a view
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class DocumentTypeLookupRetriever implements Component
{
	public function execute()
	{
		$lookup_document_types = LookupDocumentType::all();
		$document_types = array();
		$document_types[-1] = "Select Document Type";
		foreach($lookup_document_types as $document_type)
		{
			$document_types[$document_type->id] = $document_type->description;
		}
		return $document_types;
	}
}