<?php

use Illuminate\Database\Seeder;
use jericho\PropertyFlip;
use jericho\Note;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Note::truncate();
    	
    	$property_flip = PropertyFlip::find(1);
    	
        $note = new Note();
        $note->description = "This is a test note";
        $note->created_by_id = 1;
        
        $property_flip->notes()->save($note);
    }
}
