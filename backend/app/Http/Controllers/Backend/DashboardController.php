<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Code;
use App\Contact;
use App\Campaign;

class DashboardController extends Controller
{
    public function dashboard()
	{
	
		  $today=date('Y-m-d');
		
		 $campcount = Campaign::where('status', '=', '1')->count();
		 $camplist = Campaign::where('status', '=', '1')->limit(12)->orderby('id','ASC')->get();
		 
		 
		 $todaycount = Contact::where('status', '=', '1')
					->whereRaw("DATE(created_at) = '$today'")->count();
					//dd($todaycount);
		 $todayrec = Contact::where('status', '=', '1')
					->whereRaw("'DATE(created_at)' = '$today'")->get();

		
		
		return view('backend.dashboard',compact('todaycount','todayrec','campcount','camplist'));
	}
	
	public function getcampaign(Request $request,$id)
	{
		
		
		 $contacts = Contact::select("contacts.*", "gifts.gift_name","codes.campaign_id","codes.qr_id","states.name as state_name")
        ->leftjoin("gifts", "gifts.id", "=", "contacts.gift_id")
        ->leftjoin("states", "states.id", "=", "contacts.state_id")
		->leftjoin("codes", "codes.code", "=", "contacts.code")
		->where('contacts.status', '=', '1')->where('codes.campaign_id', '=',$id)->get();




        return \View::make('backend.contact',compact('contacts'));
		
	}
	
	public function todaysscannedlist()
	{
		 $today=date('Y-m-d');
		 $contacts = Contact::select("contacts.*", "gifts.gift_name","codes.campaign_id","codes.qr_id","states.name as state_name")
        ->leftjoin("gifts", "gifts.id", "=", "contacts.gift_id")
        ->leftjoin("states", "states.id", "=", "contacts.state_id")
		->leftjoin("codes", "codes.code", "=", "contacts.code")
		->where('contacts.status', '=', '1')->whereDate('contacts.created_at', '=', $today)->get();

	
        return \View::make('backend.contact',compact('contacts'));
		
	}
	
	
	
}
