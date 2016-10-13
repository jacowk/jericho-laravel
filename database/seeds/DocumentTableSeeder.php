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
    	$property_flip = PropertyFlip::find(1);
        $document = new Document();
        $document->description = "Test";
        $document->generated_filename = "test.pdf";
        $document->file_size = 100;
        $document->created_by_id = 1;
        $property_flip->documents()->save($document);
    }
}
