<?php

namespace jericho\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use jericho\DiaryItem;
use DB;
use DateTime;

/**
 * An artisan that is to be scheduled to allocate diary items to users for followup, for the current date.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-13
 *
 */
class AllocateDiaryItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jericho:allocate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allocate diary items to users for followup';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	Log::info("Allocating diary items: " . date('Y-m-d H:i:s'));
//     	$diary_items_to_allocate = DiaryItem::where('followup_date', date('Y-m-d')) /* Current date */
// 	    								->where('status_id', 1) /* Open status */
// 	    								->whereRaw('(allocated_user_id is null or followup_user_id <> allocated_user_id)')
//     									->get();
    	
//     	$now = new DateTime();
// Log::info("Now: " . date_format($now, 'Y-m-d H:i:s'));
    	
    	$this_morning = new DateTime('today');
// Log::info("Today: " . date_format($today, 'Y-m-d H:i:s'));

    	$tomorrow_morning = new DateTime('tomorrow');
// Log::info("Tomorrow: " . date_format($tomorrow, 'Y-m-d H:i:s'));


    	$diary_items_to_allocate = DiaryItem::whereBetween('followup_date', [$this_morning, $tomorrow_morning]) /* Current date */
	    								->where('status_id', 1) /* Open status */
	    								->whereRaw('(allocated_user_id is null or followup_user_id <> allocated_user_id)')
    									->get();
    	
    	/* Loop and allocate */
    	if ($diary_items_to_allocate && count($diary_items_to_allocate) > 0)
    	{
	    	foreach ($diary_items_to_allocate as $diary_item_to_allocate)
	    	{
	    		DiaryItem::where('id' , '=', $diary_item_to_allocate->id)
	    			->where('followup_user_id', '=', $diary_item_to_allocate->followup_user_id)
	    			->where('status_id', '=', 1)
	    			->update(['allocated_user_id' => $diary_item_to_allocate->followup_user_id]);
	    		Log::info("Allocated diary item " . $diary_item_to_allocate->id .
	    					" for property flip " . $diary_item_to_allocate->property_flip_id .
	    					" to user " . $diary_item_to_allocate->allocated_user_id);
	    	}
    	}
    	else
    	{
    		Log::info("No diary items to allocate");
    	}
    	Log::info("Done Allocating: " . date('Y-m-d H:i:s'));
    }
}
