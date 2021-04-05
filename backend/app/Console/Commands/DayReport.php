<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Contact;
use App\Gift;
use App\GiftAssignments;
use App\Code;
use App\Bsms;
use App\State;
use App\Giftbypincode;
use App\Campaign;
use Mail;
use File;

class DayReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contacts:report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Report';

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
        //$current_date=date('Y-m-d');
		$current_date='2019-11-28';
       			
		$email_subject='Test Cron';
	Mail::send('email.Hello',[

						 ], function($message) use ($email_subject){
							 $message->to('priyanshi@interactivebees.com','Magik Lights');
							 $message->cc('priyanshi@interactivebees.com','Magik Lights');
							  $message->from('priyanshi@interactivebees.com','Magik Lights');
							 $message->subject($email_subject);
							 $message->attach($csvattach);
							 
							
						  });


       			
		 $selSumcount = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
					->leftJoin('gifts', 'gifts.id', '=', 'contacts.gift_id')
					->leftJoin('codes', 'codes.code', '=', 'contacts.code')
					->select('contacts.*', 'states.name as state_name','gifts.gift_name',	'codes.campaign_id','codes.campaign_name')
					->whereDate('contacts.created_at', '=', $current_date)->count();


		if($selSumcount)
		{
			 $selSumm1 = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
					->leftJoin('gifts', 'gifts.id', '=', 'contacts.gift_id')
					->leftJoin('codes', 'codes.code', '=', 'contacts.code')
					->select('contacts.*', 'states.name as state_name','gifts.gift_name',	'codes.campaign_id','codes.campaign_name')
					->whereDate('contacts.created_at', '=', $current_date)->get();
					
			
							
		
	 
			$handle = fopen('php://output', 'w');
			
			//fputcsv($handle, array('ID','NAME'));
			$csv = "Campaign Id,Campaign Name, Gift Name,Outlet Name,Distributer Name,State,City,Person 		Name,Mobile,Email,Created At  \n";//Column headers
			foreach ($selSumm1 as $selSumm1) 
			{
				
				print_r($selSumm1);
				 if($selSumm1->state_id!=$selSumm1->state_id)
				 {
					 
				 $filename = 'Report-'.strtolower($selSumm1->state_name).'-'.$current_date . '.csv';
			

				
				$csv.= $selSumm1->campaign_id.','.$selSumm1->campaign_name.','.$selSumm1->gift_name.
						','.$selSumm1->outlet_name.','.$selSumm1->distributor_name.','.$selSumm1->state_name.
						','.$selSumm1->city.','.$selSumm1->name.','.$selSumm1->mobile.
						','.$selSumm1->email.','.$selSumm1->created_at."\n";
						
						
						$csv_handler = fopen (public_path().'/daySummary/'.$filename,'w');
						fwrite ($csv_handler,$csv);
						fclose ($csv_handler);
							
				 }
			}
			
		
		
		}

		echo 'done';
    
			
		
		
	
		
		
    }
}
