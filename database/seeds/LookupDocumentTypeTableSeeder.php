<?php

use Illuminate\Database\Seeder;
use jericho\LookupDocumentType;

/**
 * A seeder for populating the system with Document types
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-18
 *
 */
class LookupDocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
