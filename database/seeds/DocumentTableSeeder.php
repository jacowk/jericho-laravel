<?php

use Illuminate\Database\Seeder;
use jericho\PropertyFlip;
use jericho\Document;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Document::truncate();
    	
    	$property_flip = PropertyFlip::find(1);
        $document = new Document();
        $document->document_type_id = 1;
        $document->description = "Test";
        $document->generated_filename = "test.pdf";
        $document->file_size = 100;
        $document->created_by_id = 1;
        $property_flip->documents()->save($document);
    }
}
