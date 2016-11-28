<?php

use Illuminate\Database\Seeder;
use jericho\LookupDocumentType;

/**
 * A seeder for creating initial document types for the production database
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionLookupDocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	LookupDocumentType::truncate();
    	 
    	$document_type_array = array('Lightstone Report', 'FNB Report', 'Flip Calculations');
    	foreach($document_type_array as $document_type)
    	{
    		$lookup_document_type = new LookupDocumentType();
    		$lookup_document_type->description = $document_type;
    		$lookup_document_type->created_by_id = 1;
    		$lookup_document_type->save();
    	}
    }
}
