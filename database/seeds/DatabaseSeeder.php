<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UsersTableSeeder::class);
    	
        $this->call(ContactTableSeeder::class);
        $this->call(AccountTableSeeder::class);
    	$this->call(AttorneyTableSeeder::class);
        $this->call(LookupAttorneyTypeTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(ContractorTableSeeder::class);
		$this->call(LookupContractorTypeTableSeeder::class);
		$this->call(LookupDocumentTypeTableSeeder::class);
		$this->call(EstateAgentTableSeeder::class);
        $this->call(LookupEstateAgentTypeTableSeeder::class);
        $this->call(GreaterAreaTableSeeder::class);
        $this->call(IssueTableSeeder::class);
        $this->call(IssueCommentTableSeeder::class);
        $this->call(LookupMaritalStatusTableSeeder::class);
        $this->call(LookupMilestoneTypeTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(LookupTitleTableSeeder::class);
        $this->call(LookupTransactionTypeTableSeeder::class);
        $this->call(PropertyTableSeeder::class);
        
        $this->call(AttorneyContactTableSeeder::class);
        $this->call(ContactContractorTableSeeder::class);
        $this->call(ContactEstateAgentTableSeeder::class);
        $this->call(BankContactTableSeeder::class);
        $this->call(AreaTableSeeder::class);
        $this->call(SuburbTableSeeder::class);
        $this->call(PropertyFlipTableSeeder::class);
        $this->call(AttorneyPropertyFlipTableSeeder::class);
        $this->call(MilestoneTableSeeder::class);
        $this->call(NoteTableSeeder::class);
        $this->call(DocumentTableSeeder::class);
        $this->call(DiaryItemStatusTableSeeder::class);
        $this->call(FinanceStatusTableSeeder::class);
        $this->call(SellerStatusTableSeeder::class);
        $this->call(DiaryItemTableSeeder::class);
        $this->call(FollowupItemTableSeeder::class);
        $this->call(TransactionTableSeeder::class);
        $this->call(EstateAgentPropertyFlipTableSeeder::class);
        $this->call(ContractorServiceTableSeeder::class);
        $this->call(ContractorPropertyFlipTableSeeder::class);
        $this->call(BankPropertyFlipTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(LookupPropertyTypeTableSeeder::class);
        $this->call(DiaryItemCommentTableSeeder::class);
        $this->call(InvestorPropertyFlipTableSeeder::class);
        
        $this->call(IssueStatusTableSeeder::class);
        $this->call(LookupIssueComponentTableSeeder::class);
        $this->call(LookupIssueCategoryTableSeeder::class);
        $this->call(LookupIssueSeverityTableSeeder::class);
        
//         $this->call(PostalDataSeeder::class);
    }
}
