<?php

use Illuminate\Database\Seeder;
use jericho\Attorney;
use jericho\Contact;

class AttorneyContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	/* Contacts for Attorney 1 */
        $attorney = Attorney::find(1);
        
        $contact1 = new Contact();
        $contact1->title_id = 1;
        $contact1->firstname = "John";
        $contact1->surname = "Attorney";
        $contact1->home_tel_no = "(011) 777 9999";
        $contact1->work_tel_no = "(011) 777 9999";
        $contact1->cell_no = "(011) 777 9999";
        $contact1->fax_no = "(011) 777 9999";
        $contact1->personal_email = "john@test.co.za";
        $contact1->work_email = "john@test.co.za";
        $contact1->id_number = 7607205162089;
        $contact1->passport_number = "";
        $contact1->marital_status_id = 1;
        $contact1->tax_number = "12345";
        $contact1->sa_citizen = true;
        $contact1->created_by_id = 1;
        $contact1->save();
        $attorney->contacts()->attach($contact1);
         
        $contact2 = Contact::find(1);
        $attorney->contacts()->attach($contact2);
        
        /* Contacts for Attorney 2 */
        $attorney2 = Attorney::find(2);
        $contact3 = Contact::find(2);
        $attorney2->contacts()->attach($contact3);
    }
}
