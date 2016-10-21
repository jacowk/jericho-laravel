<?php

use Illuminate\Database\Seeder;
use jericho\Contact;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Contact::truncate();
    	
    	$contact1 = new Contact();
    	$contact1->title_id = 1;
    	$contact1->firstname = "John";
    	$contact1->surname = "Doe";
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
    	
    	$contact2 = new Contact();
    	$contact2->title_id = 2;
    	$contact2->firstname = "Jim";
    	$contact2->surname = "Doe";
    	$contact2->home_tel_no = "(011) 888 7777";
    	$contact2->work_tel_no = "(011) 888 7777";
    	$contact2->cell_no = "(011) 888 7777";
    	$contact2->fax_no = "(011) 888 7777";
    	$contact2->personal_email = "jim@test.co.za";
    	$contact2->work_email = "jim@test.co.za";
    	$contact2->id_number = 7607205162089;
    	$contact2->passport_number = "";
    	$contact2->marital_status_id = 2;
    	$contact2->tax_number = "56789";
    	$contact2->sa_citizen = true;
    	$contact2->created_by_id = 1;
    	$contact2->save();
    	
//     	$faker = Faker\Factory::create();
//     	foreach(range(1, 20) as $index)
//     	{
//     		Contact::create([
//     				'firstname' => $faker->firstName,
//     				'surname' => $faker->lastName,
//     				'home_tel_no' => $faker->phoneNumber,
//     				'work_tel_no' => $faker->phoneNumber,
//     				'cell_no' => $faker->phoneNumber,
//     				'fax_no' => $faker->phoneNumber,
//     				'personal_email' => $faker->email,
//     				'work_email' => $faker->email,
//     				'sa_citizen' => true,
//     				'created_by_id' => 1
//     		]);
//     	}
    }
}
