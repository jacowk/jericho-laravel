<?php

use Illuminate\Database\Seeder;
use jericho\Attorney;
use OwenIt\Auditing\Auditing;
use jericho\Bank;
use jericho\Contact;
use jericho\ContractorService;
use jericho\Contractor;
use jericho\DiaryItemComment;
use jericho\DiaryItemStatus;
use jericho\DiaryItem;
use jericho\Document;
use jericho\EstateAgent;
use jericho\FinanceStatus;
use jericho\FollowupItem;
use jericho\IssueComment;
use jericho\IssueStatus;
use jericho\Issue;
use jericho\Milestone;
use jericho\Note;
use jericho\Permission;
use jericho\PropertyFlip;
use jericho\Property;
use jericho\Transaction;
use Illuminate\Support\Facades\DB;

/**
 * This seeder is to prepare tables that are not seeded for production, for production
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-28
 *
 */
class ProductionPreparationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('attorney_contact')->truncate();
    	DB::table('attorney_property_flip')->truncate();
    	DB::table('bank_contact')->truncate();
    	DB::table('bank_property_flip')->truncate();
    	DB::table('contact_contractor')->truncate();
    	DB::table('contact_estate_agent')->truncate();
    	DB::table('contractor_property_flip')->truncate();
    	DB::table('estate_agent_property_flip')->truncate();
    	DB::table('investor_property_flip')->truncate();
    	DB::table('permission_role')->truncate();
    	Attorney::truncate();
    	Auditing::truncate();
    	Bank::truncate();
    	Contact::truncate();
    	ContractorService::truncate();
    	Contractor::truncate();
    	DiaryItemComment::truncate();
    	DiaryItemStatus::truncate();
    	DiaryItem::truncate();
    	Document::truncate();
    	EstateAgent::truncate();
    	FinanceStatus::truncate();
    	FollowupItem::truncate();
    	IssueComment::truncate();
    	IssueStatus::truncate();
    	Issue::truncate();
    	Milestone::truncate();
    	Note::truncate();
    	Permission::truncate();
    	PropertyFlip::truncate();
    	Property::truncate();
    	Transaction::truncate();
    }
}
