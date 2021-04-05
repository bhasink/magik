<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Contact;
use App\Http\Controllers\APIBaseController as APIBaseController;
use App\Gift;
use App\GiftAssignments;
use App\Code;
use App\Bsms;
use App\State;
use App\Giftbypincode;
use App\Campaign;
use App\GiftbySequence;
use Mail;
use File;
use Symfony\Component\HttpFoundation\StreamedResponse;
class ContactController extends APIBaseController
{

    public function index()
    {
        $posts = Post::all();
        return $this->sendResponse($posts->toArray(), 'Contacts retrieved successfully.');
    }


public function getCampaign(request $request)
	{
		
		 $Campaign = Code::where('code', '=', $request->code)->first();
		 $Campaign = Campaign::where('campaign_id', '=', $Campaign->campaign_id)->first();
			$Campaign->campaign_name;
			$Campaign->image;
			
			$local='192.168.1.19/magikqrcode';
			$server='https://www.magiklights.com/qrcode/backend';
			$input['name']=$Campaign->campaign_name;
			$input['image']=$server.$Campaign->image;
			
			$input['base_path']=$server;
			
			     //   return '<script type="text/javascript">alert("hello!");</script>';

// 			echo "<script>";
            // echo "alert('hello');";
            // echo "</script>";

		//return json_encode($Campaign->toArray());
		return $this->sendResponse($input, 'Campaign');
		
	}

	public function termConditions()
	{

		 $content='<ul>
					<li>This QR Code scheme is valid for only retailers. Not valid for distributors or sub stockist.</li>
					<li>This gift can be availed only if the retailer purchases the entire carton.</li>
					<li>The distributor should hand over the card back to the company, in case the entire carton is not purchased by one party.</li>
					<li>The QR code can only be scanned once to redeem the gift.</li>
					<li>Century LED reserves the right to withdraw or modify this scheme at any time without prior notice.</li>
					<li>Rewards will be handed over after the scheme period is over.</li>
					<li>Images used are for representation purpose only. Actual reward may vary as per availability.</li>
					<li>Incase of two wheeler, ex showroom cost of standard model will be reimbursed through credit note
					Subject to Kolkata Jurisdiction only.</li>
					<li>Scheme valid till 31st January, 2020.
					</ul>';

		//return $this->sendResponse(preg_replace("/\t/g/",'',$content), 'Term Condition Content');
	return json_encode(trim(preg_replace('/\s+/',' ',$content)));
		//return json_encode(trim($content));



	}

	public function stateList(){

		 $state = State::where('status', '=','1')->orderBy('name')->get();
		 //dd($state->toArray());
		 return json_encode($state);
	//return $this->sendResponse($state->toArray(), 'State List retrieved successfully.');


	}



    public function AddConatact(Request $request)
    {
        
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");

        $input = $request->all();

       /* $validator = Validator::make($input, [
            'name' => 'required',
            'mobile' => 'required'
        ]);*/

        $validator =Validator::make($request->all(), [
            'code'=> 'required|string|max:255',
            'outlet_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'mobile' => 'required|min:10|numeric',
            'distributor_name'=> 'required|regex:/^[a-zA-Z ]+$/u|max:255',
            'city'=> 'required|string|max:255',
			'state_id'=> 'required',
        ],[

            'code.required' => 'QR Code is required',
            'outlet_name.required' => 'Outlet Name field is required',
            'name.required' => 'Name field is required',
            'mobile.required' => 'Mobile field is required',
            'distributor_name.required'=> 'Distributor Name field is required',
            'city.required'=> 'City field is required',
			'state_id'=> 'required',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


      $cd = Code::where('code', '=', $request->code)->get();

        if($cd->count()==0)
		{
            return $this->sendError('Invalid QR code. Please try again.');
        }




        $cd = Code::where('code', '=', $request->code)->where('scan', '=',1)->get();

        if($cd->count()==1){
            return $this->sendError('QR code has been scanned. Please try other one.');
        }




	//dd($input);
        $input['state_id']=$request->state_id;// new parameter
       //echo  $input['state_id']=1;// new parameter
        $input['code']=$request->code;
        $input['status']=0;
        $post = Contact::create($input);


        $cd=Code::where('code', '=', $request->code)->first();

        if(isset($cd)) {
            $cd->scan = 1;
            $cd->save();
        }

			


	        $gift = Contact::where('code', '=', $request->code)->first();


			 $Campaign = Code::where('code', '=', $request->code)->first();
			 
			 $Campaignid = Campaign::where('campaign_id', '=',  $Campaign->campaign_id)->first();
			 
			 $type=$Campaignid->type;
			 
			 #fixed method to set the gift priority
		 if($type==2)
		 {
			 
			$rotid=$Campaignid->current_rotation;
			
			
			 $serialno = Contact::where('campaign_id','=',$Campaignid->campaign_id)->where('rotid','=',$rotid)->count();

			$serialno=$serialno+1;
			//$giftbystate=GiftbySequence::where('serialno','=',$serialno)->where('campaign_id','=',$Campaignid->campaign_id)->where('state_id','=',$request->state_id)->count();
			
			 $giftbystate=GiftbySequence::where('campaign_id','=',$Campaignid->campaign_id)->where('state_id','=',$request->state_id)->where('state_is_active','=','1')
			     
			    //->whereRaw("FIND_IN_SET('".$request->city."',city)")
			    ->Where('mobileno', '=',$request->mobile)
			    ->count();
			
			
			if($giftbystate)
			{
				$giftbystate=GiftbySequence::where('campaign_id','=',$Campaignid->campaign_id)->where('state_id','=',$request->state_id)->where('state_is_active','=','1')
		    
			    //->whereRaw("FIND_IN_SET('".$request->city."',city)")
			    ->Where('mobileno', '=',$request->mobile)
			    ->first();
				
				
				$gift_id=$giftbystate->giftid;
				
					$giftcontact = Contact::where('code', '=', $request->code)->first();
					
					
				 $giftcontact->gift_id =  $gift_id;
				 $giftcontact->campaign_id =  $Campaignid->campaign_id;
				 $giftcontact->rotid =  0;
				$giftcontact->serial_no =  0;
			
				 $giftcontact->save();
				 
				  $giftbystate->state_is_active=0;
					 
					  $giftbystate->save();
					  
					  $giftbystate=GiftbySequence::where('state_id','=',$request->state_id)->where('state_is_active','=','1')->count();
					  if($giftbystate)
					  {
					    $update=  GiftbySequence::where('state_is_active', 1)
									->where('state_id','=',$request->state_id)
									->update(['state_is_active' => 0]);
					  }
			}
			else{
		
			$giftreccount=GiftbySequence::where('serialno','=',$serialno)->where('campaign_id','=',$Campaignid->campaign_id)->where('state_id','=','0')->count();
			
			$giftrec=GiftbySequence::where('serialno','=',$serialno)->where('campaign_id','=',$Campaignid->campaign_id)->where('state_id','=','0')->first();
				if($giftreccount)
				{
					
				$gift_id=$giftrec->giftid;
				}
			else{
				
				$gt=Gift::where('status', '=','1')->where('quantity','>',0)->where('campaign_id','=',$Campaignid->campaign_id)->inRandomOrder()->first();
				 
				 $gift_id=$gt->id;
				}
				
					$giftcontact = Contact::where('code', '=', $request->code)->first();
					
					
				 $giftcontact->gift_id =  $gift_id;
				 $giftcontact->campaign_id =  $Campaignid->campaign_id;
				 $giftcontact->rotid =  $rotid;
				$giftcontact->serial_no =  $serialno;
				
				 $giftcontact->save();
			}
			
			
			
			$gt=Gift::where('id','=',$gift_id)->first();
			
			
		
				 if($serialno==$Campaignid->batch_size)
				 {
					 $Campaignid->current_rotation=$rotid+1;
					 $Campaignid->save();
				 }
				 
				 
				 
				 
				 	
		 $gift=Gift::where('id', '=', $gt->id)->first();
		 
        $post1 = Contact::where('code', '=', $request->code)->where('gift_id', '=', $gt->id)
                ->where('status', '=', 0)->count();
                
    //   dd($request->code);
        
                
        if($post1==1)
	    {

            $post = Contact::where('code', '=', $request->code)->where('gift_id', '=', $gt->id)->first();
            $post->status = 1;
            $post->save();
            
            $countgift = Gift::where('id', '=', $gt->id)->get()->first();


        	if($countgift->quantity >0)
        	{
        		$upd = Gift::where('id', '=', $gt->id)->first();
        		$upd->decrement('quantity', 1);
        
        	}
        	
        	$cd = Code::where('code', '=', $request->code)->first();

            $campign = Campaign::where('campaign_id', '=', $cd->campaign_id)->first();
        	
        	$campign_name=$campign->campaign_name;
        	

        	$conSateSel = Contact::where('code', '=', $request->code)->first();
        	$giftStatesel=Giftbypincode::where('gift_id', '=', $gt->id)->where('state', '=', $conSateSel->state_id)->first();


            $v1=$gift->gift_name;

            $goldgift = "Gold";
			$Scootygift = "Scooty";
			$Silvergift = "Silver";
			
			if($campign_name == "Maximo Prime 24W Batten - 21.07.2020.")
			{
			    	$msg="Congratulations for winning $v1 in the Maximo Prime 24W Batten scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			else{
			if(strpos($v1, $goldgift) !== false || strpos($v1, $Scootygift) !== false || strpos($v1, $Silvergift) !== false)
			{
				
			$msg="Congratulations for winning $v1 in the $campign_name. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
				
			} 
			else{
			$msg="Congratulations for winning $v1 in the $campign_name. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			 }

			}
			
			if($campign_name == 'POWER PLUS - 17.09.2020')
			{
    			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name == 'POWER PLUS - 13.08.2020')
			{
			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name == 'MAXIMO PRIME 24W BATTEN Scratch & Win')
			{
			    	$msg="Congratulations for winning $v1 in the Maximo Prime scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			
			
			if($campign_name== "Ultima Line -09.10.2020")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
		
				if($campign_name== "Ultima Line-5 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			    if($campign_name== "Ultima Line-4 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
				if($campign_name== "Ultima Line-3 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
				if($campign_name== "Ultima Line-2 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
				if($campign_name== "Ultima Line-1 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
		
			if($campign_name== "PRISM PLUS 40W - 02.6.2020")
			{
			    	$msg="Congratulations for winning $v1 in the PRISM PLUS 40W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "POWER PLUS - 05.02.2021")
				{
			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts.Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			
			if($campign_name== "POWER PLUS - 15.12.2020")
				{
			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts.Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "MAXIMO PRIME 24W Scratch & Win")
			{
			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "MAXIMO PRIME 24W BATTEN - 18.09.2020")
			{
			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "Maximo Prime 24W - 15.12.2020")
			{
			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "Ultima Line - 18.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "PRISM PLUS 40W - SCRATCH & WIN CONTEST")
			{
			    	$msg="Congratulations for winning $v1 in the PRISM PLUS 40W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
		
			
			$msg = urlencode($msg);
			
			$mob=$post->mobile;
	
			$v1=$gift->gift_name;
			$v2="helpdesk@magiklights.com";
			
			//$url = "http://bulksmsindia.mobi/sendurlcomma.aspx?user=20089500&pwd=uprbgb@09&senderid=MAGIKL&mobileno=".$mob."&msgtext=".urlencode($msg);
// 			$url = "http://alerts.digimiles.in/sendsms/bulksms?username=di80-century&password=digimile&type=0&dlr=1&destination=8076534022&source=CNTLED&message='sdf'";
			$url = "http://alerts.digimiles.in/sendsms/bulksms?username=di80-century&password=digimile&type=0&dlr=1&destination=$mob&source=CNTLED&message=$msg";
			
            $ch = curl_init($url);
               curl_setopt($ch, CURLOPT_HEADER, 0);
               curl_setopt($ch, CURLOPT_POST, 0);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
               sleep(5);

               $response = curl_exec($ch);
               curl_close($ch);

		  //  echo 'true';


	    }else{
	       //  echo 'false'; 
	    }
		  

		
		
		
		
				 return $this->sendResponse($post->toArray(), $gt->toArray());
			
			 }
			 
			 
			 # Default Method to set the gift by random
			 
             $gtcount=Gift::where('status', '=', 1)->where('quantity', '>', 0)
						->where('campaign_id','=',$Campaign->campaign_id)->count();
						
			if($gtcount>0)
			{
				 $gt=Gift::where('status', '=','1')->where('quantity','>',0)->where('campaign_id','=',$Campaign->campaign_id)->inRandomOrder()->first();
				 
				 if($gt['type']=='1')
				 {
					 $giftstatestatus=Giftbypincode::where('status','=','1')->where('state', '=', $request->state_id)->where('gift_id','=',$gt['id'])->where('campaign_id','=',$Campaign->campaign_id)->count();

					 if($giftstatestatus)
					 {
						$giftcontact = Contact::where('code', '=', $request->code)->first();
						 $giftcontact->gift_id =  $gt->id;
						 $giftcontact->save();
						  $giftstatestatus=Giftbypincode::where('status','=','1')->where('state', '=', $request->state_id)->where('gift_id','=',$gt['id'])->where('campaign_id','=',$Campaign->campaign_id)->first();
						  $giftstatestatus->status=0;
						  $giftstatestatus->save();
					 }
				 else{
					//echo 'hi';
					 //$gt=Gift::where('status', '=','1')->where('quantity','>',0)->inRandomOrder()->first();
						$gt=Gift::where('status', '=','1')->where('quantity','>',0)->where('type','=','0')->where('campaign_id','=',$Campaign->campaign_id)->inRandomOrder()->first();
						
						$giftcontact = Contact::where('code', '=', $request->code)->first();
					 $giftcontact->gift_id =  $gt->id;
					 $giftcontact->save();
				 }

			}
			else{
				//echo 'hello';
				//$gt=Gift::where('status', '=','1')->where('quantity','>',0)->inRandomOrder()->first();
				$gt=Gift::where('status', '=','1')->where('quantity','>',0)->where('type','=','0')->where('campaign_id','=',$Campaign->campaign_id)->inRandomOrder()->first();
			//echo $gt->id;
				$giftcontact = Contact::where('code', '=', $request->code)->first();
				 $giftcontact->gift_id =  $gt->id;
				 $giftcontact->save();

			}
			}
			else{
				return $this->sendError('Invalid QR code. Please try again.');
			}
		//end
		
		
		
		

		
		
		 $gift=Gift::where('id', '=', $gt->id)->first();
        
        $post1 = Contact::where('code', '=', $request->code)->where('gift_id', '=', $gt->id)
                ->where('status', '=', 0)->count();
                
                
        if($post1==1)
	    {

            $post = Contact::where('code', '=', $request->code)->where('gift_id', '=', $gt->id)->first();
            $post->status = 1;
            $post->save();
            
            $countgift = Gift::where('id', '=', $gt->id)->get()->first();


        	if($countgift->quantity >0)
        	{
        		$upd = Gift::where('id', '=', $gt->id)->first();
        		$upd->decrement('quantity', 1);
        
        	}
        	
        	$cd = Code::where('code', '=', $request->code)->first();

            $campign = Campaign::where('campaign_id', '=', $cd->campaign_id)->first();
        	
        	$campign_name=$campign->campaign_name;
        	

        	$conSateSel = Contact::where('code', '=', $request->code)->first();
        	$giftStatesel=Giftbypincode::where('gift_id', '=', $gt->id)->where('state', '=', $conSateSel->state_id)->first();


            $v1=$gift->gift_name;

            $goldgift = "Gold";
			$Scootygift = "Scooty";
			$Silvergift = "Silver";
			
			if($campign_name == "Maximo Prime 24W Batten - 21.07.2020.")
			{
			    	$msg="Congratulations for winning $v1 in the Maximo Prime 24W Batten scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			else{
			if(strpos($v1, $goldgift) !== false || strpos($v1, $Scootygift) !== false || strpos($v1, $Silvergift) !== false)
			{
				
			$msg="Congratulations for winning $v1 in the $campign_name. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
				
			} 
			else{
			$msg="Congratulations for winning $v1 in the $campign_name. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			 }

			}
			
			if($campign_name == 'POWER PLUS - 17.09.2020')
			{
    			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name == 'POWER PLUS - 13.08.2020')
			{
			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			
			if($campign_name== "Ultima Line -09.10.2020")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
		
				if($campign_name== "Ultima Line-5 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			    if($campign_name== "Ultima Line-4 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
				if($campign_name== "Ultima Line-3 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
				if($campign_name== "Ultima Line-2 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
				if($campign_name== "Ultima Line-1 - 05.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
		
			if($campign_name== "PRISM PLUS 40W - 02.6.2020")
			{
			    	$msg="Congratulations for winning $v1 in the PRISM PLUS 40W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "POWER PLUS - 05.02.2021")
				{
			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts.Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			
			if($campign_name== "POWER PLUS - 15.12.2020")
				{
			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts.Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "MAXIMO PRIME 24W Scratch & Win")
			{
			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "MAXIMO PRIME 24W BATTEN - 18.09.2020")
			{
			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "Maximo Prime 24W - 15.12.2020")
			{
			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "Ultima Line - 18.02.2021")
			{
			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
			if($campign_name== "PRISM PLUS 40W - SCRATCH & WIN CONTEST")
			{
			    	$msg="Congratulations for winning $v1 in the PRISM PLUS 40W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
			}
		
			
			$msg = urlencode($msg);
			
			$mob=$post->mobile;
	
			$v1=$gift->gift_name;
			$v2="helpdesk@magiklights.com";
			
			//$url = "http://bulksmsindia.mobi/sendurlcomma.aspx?user=20089500&pwd=uprbgb@09&senderid=MAGIKL&mobileno=".$mob."&msgtext=".urlencode($msg);
// 			$url = "http://alerts.digimiles.in/sendsms/bulksms?username=di80-century&password=digimile&type=0&dlr=1&destination=8076534022&source=CNTLED&message='sdf'";
			$url = "http://alerts.digimiles.in/sendsms/bulksms?username=di80-century&password=digimile&type=0&dlr=1&destination=$mob&source=CNTLED&message=$msg";
			
            $ch = curl_init($url);
               curl_setopt($ch, CURLOPT_HEADER, 0);
               curl_setopt($ch, CURLOPT_POST, 0);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
               $response = curl_exec($ch);
               sleep(5);

               curl_close($ch);

		  //  echo 'true';


	    }else{
	       //  echo 'false'; 
	    }
		  

		
		
		
		
		
		
		
		

        return $this->sendResponse($post->toArray(), $gt->toArray());
    }


    public function Gift(Request $request)
    {
        $post = Contact::where('code', '=', $request->code)->get();

        if($post->count()==0){
            return $this->sendError('Gift not found.');
        }else{
            $post = $post->first();
        }


        if($post->gift_id=='')
        {
            $gt=Gift::where('status', '=', 1)->where('quantity', '>', 0)->inRandomOrder()->first();
            $post->gift_id =  $gt->id;
            $post->save();
        }
        else
        {
            $gt = Gift::where('id', '=', $post->gift_id)->first();
        }

        return $this->sendResponse($gt->toArray(), 'Gift retrieved successfully.');
    }



    public function Check(Request $request)
    {

        $cds = Code::where('code', '=', $request->code)->where('scan', '=', 1)->get();
        if($cds->count()==1)
        {
            return $this->sendError('Your QR Code already Scaned');
        }
        else
        {
            $cds = Code::where('code', '=', $request->code)->get();
            if($cds->count()==0)
            {
                return $this->sendError('Invalid QR code. Please try again.');
            }
        }
        return $this->sendResponse($cds->toArray(), 'Success');
    }





    public function show($id)
    {
        $post = Contact::find($id);


        if (is_null($post)) {
            return $this->sendError('Contacts not found.');
        }


        return $this->sendResponse($post->toArray(), 'Contacts retrieved successfully.');
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'mobile' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $post = Contact::find($id);
        if (is_null($post)) {
            return $this->sendError('Contacts not found.');
        }


        $post->name = $input['name'];
        $post->mobile = $input['mobile'];
        $post->save();


        return $this->sendResponse($post->toArray(), 'Contacts updated successfully.');
    }



    public function destroy($id)
    {
        $post = Contact::find($id);


        if (is_null($post)) {
            return $this->sendError('Contacts not found.');
        }


        $post->delete();


        return $this->sendResponse($id, 'Contacts deleted successfully.');
    }

    public function GiftUpdate(Request $request)
    {

        
//         header("Access-Control-Allow-Origin: *");
//         header("Access-Control-Request-Headers: GET,POST,OPTIONS,DELETE,PUT");

//         $gift=Gift::where('id', '=', $request->id)->first();
        
//         $post1 = Contact::where('code', '=', $request->code)->where('gift_id', '=', $request->id)
//                 ->where('status', '=', 0)->count();
                
                
//         if($post1==1)
// 	    {

//             $post = Contact::where('code', '=', $request->code)->where('gift_id', '=', $request->id)->first();
//             $post->status = 1;
//             $post->save();
            
//             $countgift = Gift::where('id', '=', $request->id)->get()->first();


//         	if($countgift->quantity >0)
//         	{
//         		$upd = Gift::where('id', '=', $request->id)->first();
//         		$upd->decrement('quantity', 1);
        
//         	}
        	
//         	$cd = Code::where('code', '=', $request->code)->first();

//             $campign = Campaign::where('campaign_id', '=', $cd->campaign_id)->first();
        	
//         	$campign_name=$campign->campaign_name;
        	

//         	$conSateSel = Contact::where('code', '=', $request->code)->first();
//         	$giftStatesel=Giftbypincode::where('gift_id', '=', $request->id)->where('state', '=', $conSateSel->state_id)->first();


//             $v1=$gift->gift_name;

//             $goldgift = "Gold";
// 			$Scootygift = "Scooty";
// 			$Silvergift = "Silver";
			
// 			if($campign_name == "Maximo Prime 24W Batten - 21.07.2020.")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Maximo Prime 24W Batten scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			else{
// 			if(strpos($v1, $goldgift) !== false || strpos($v1, $Scootygift) !== false || strpos($v1, $Silvergift) !== false)
// 			{
				
// 			$msg="Congratulations for winning $v1 in the $campign_name. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
				
// 			} 
// 			else{
// 			$msg="Congratulations for winning $v1 in the $campign_name. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
// 			 }

// 			}
			
// 			if($campign_name == 'POWER PLUS - 17.09.2020')
// 			{
//     			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name == 'POWER PLUS - 13.08.2020')
// 			{
// 			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
			
// 			if($campign_name== "Ultima Line -09.10.2020")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
		
// 				if($campign_name== "Ultima Line-5 - 05.02.2021")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			    if($campign_name== "Ultima Line-4 - 05.02.2021")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 				if($campign_name== "Ultima Line-3 - 05.02.2021")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 				if($campign_name== "Ultima Line-2 - 05.02.2021")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 				if($campign_name== "Ultima Line-1 - 05.02.2021")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
		
// 			if($campign_name== "PRISM PLUS 40W - 02.6.2020")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the PRISM PLUS 40W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name== "POWER PLUS - 05.02.2021")
// 				{
// 			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts.Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
			
// 			if($campign_name== "POWER PLUS - 15.12.2020")
// 				{
// 			    	$msg="Congratulations for winning $v1 in the POWER PLUS scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts.Limited Time Offer. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name== "MAXIMO PRIME 24W Scratch & Win")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name== "MAXIMO PRIME 24W BATTEN - 18.09.2020")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name== "Maximo Prime 24W - 15.12.2020")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the MAXIMO PRIME 24W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name== "Ultima Line - 18.02.2021")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the Ultima Line scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
// 			if($campign_name== "PRISM PLUS 40W - SCRATCH & WIN CONTEST")
// 			{
// 			    	$msg="Congratulations for winning $v1 in the PRISM PLUS 40W scheme. Our sales executive will get in touch with you. Purchase more cartons to win more gifts. Limited Time Offer. Leaflet Ref No.  - $cd->qr_id. Watch film https://bit.ly/32Hdyri.";
			    
// 			}
		
			
// 			$msg = urlencode($msg);
			
// 			$mob=$post->mobile;
	
// 			$v1=$gift->gift_name;
// 			$v2="helpdesk@magiklights.com";
			
// 			//$url = "http://bulksmsindia.mobi/sendurlcomma.aspx?user=20089500&pwd=uprbgb@09&senderid=MAGIKL&mobileno=".$mob."&msgtext=".urlencode($msg);
// // 			$url = "http://alerts.digimiles.in/sendsms/bulksms?username=di80-century&password=digimile&type=0&dlr=1&destination=8076534022&source=CNTLED&message='sdf'";
// 			$url = "http://alerts.digimiles.in/sendsms/bulksms?username=di80-century&password=digimile&type=0&dlr=1&destination=$mob&source=CNTLED&message=$msg";
			
//             $ch = curl_init($url);
//               curl_setopt($ch, CURLOPT_HEADER, 0);
//               curl_setopt($ch, CURLOPT_POST, 0);
//               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
//               $response = curl_exec($ch);
//               curl_close($ch);

// 		    echo 'true';


// 	    }else{
// 	         echo 'false'; 
// 	    }
		  

		

    }



 public function generateCSV(Request $request)
    {


        $current_date=date('Y-m-d');
	//	$current_date='2019-12-08';
       			
		 $selSumcount = Contact::whereDate('contacts.created_at', '=', $current_date)->count();


		if($selSumcount)
		{
			 
			 $selstates = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
						->select('contacts.state_id', 'states.name')
						->whereDate('contacts.created_at', '=', $current_date)->get();
					
			foreach ($selstates as $selstates) 
			{
				$filename = 'Report-'.strtolower($selstates->name).'-'.$current_date . '.csv';
				$csv= "Campaign Id,Campaign Name, Gift Name,Outlet Name,Distributer Name,State,City,Person Name,Mobile,Email,        Created At  \n";//Column headers
				$csv_handler = fopen (public_path().'/daySummary/'.$filename,'w');
				
				fwrite ($csv_handler,$csv);
			}
			
				
			$selContacts = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
					->leftJoin('gifts', 'gifts.id', '=', 'contacts.gift_id')
					->leftJoin('codes', 'codes.code', '=', 'contacts.code')
					->select('contacts.*', 'states.name as state_name','gifts.gift_name',	'codes.campaign_id','codes.campaign_name')
					->whereDate('contacts.created_at', '=', $current_date)->get();
								
			
			foreach ($selContacts as $selSumm1) 
			{
				$filename = 'Report-'.strtolower($selSumm1->state_name).'-'.$current_date . '.csv';
				if($selSumm1->state_id==$selSumm1->state_id)
				{
					//echo '3';
					$csv2= $selSumm1->campaign_id.','.$selSumm1->campaign_name.','.$selSumm1->gift_name.
					','.$selSumm1->outlet_name.','.$selSumm1->distributor_name.','.$selSumm1->state_name.
					','.$selSumm1->city.','.$selSumm1->name.','.$selSumm1->mobile.
					','.$selSumm1->email.','.$selSumm1->created_at."\n";
				}
	 
				$csv_handler = fopen (public_path().'/daySummary/'.$filename,'a');
				fwrite ($csv_handler,$csv2);
				fclose ($csv_handler);	
					
			}
		
		
		}

		echo 'done';
    


	}
	
	public function DaySummary(Request $request)
    {

        
	$current_date=date('Y-m-d');
		
       			
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
					->whereDate('contacts.created_at', '=', $current_date)->groupBy('contacts.state_id')->get();
					
			

		
		//$bsmsCount = Bsms::where('state', '=', $selSumm1->state_id)->get()->count();
		foreach ($selSumm1 as $selSumm1) 
		{
		 	$state=$selSumm1['state_name'];
			$filename = 'Report-'.strtolower($state).'-'. $current_date . '.csv';
			
			$csvattach =public_path().'/daySummary/'.$filename;

			$email_subject='Todays Report from '.$state;
		    $bsmslist = Bsms::where('state', '=', $selSumm1['state_id'])->where('status', '=', '1')->get();

        	$bmsemailsarr=array();
        	$rsmmailsarr=array();
				foreach($bsmslist as  $key => $value )
				{
                    //print_r($bsmslist);

						$bmstype=$value->type;
						
						if($bmstype=='1')
						{
							$bmsemails=$value->email;
							$bmsemailsarr[]=trim($bmsemails);
						}
						elseif($bmstype=='2')
						{
							$rsmemails=$value->email;
							$rsmmailsarr[]=trim($rsmemails);
						}
                        
				    	

			    }
			    
			    $input['state']= ucfirst(strtolower($state));
			    $input['date']=$current_date;
			    
			    $anothercc=array('pallavi.bachhawat@centuryled.in');
				
				$rsmemails=array_merge($rsmmailsarr,$anothercc);
				//$bcclist=array('monika.thakran@interactivebees.com');
				
					Mail::send('email.Report',[
					    'input'=>$input

					 ], function($message) use ($bmsemailsarr,$rsmemails,$email_subject,$csvattach,$bcclist){
						 $message->to($bmsemailsarr,'Magik Lights');
					 //$message->to('priyanshi@interactivebees.com','Magik Lights');
				    	$message->cc($rsmemails,'Magik Lights');
					     $message->bcc($bcclist,'Magik Lights');
						 $message->subject($email_subject);
						 $message->attach($csvattach);
						 
						
					 });

			}
		
		
		}

		echo 'done';
    

	}
	
	#Generate Weekly CSV Report
	public function generateWeeklyCsv()
	{
	    
	   
		$current_date=date('Y-m-d');
       		
			
			$ts = strtotime($current_date);
			$start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
	
			 $fromdate=	date('Y-m-d', $start);
			
			  $enddate=date('Y-m-d', strtotime('next sunday', $start));
			 
		
    
		 //$fromdate='2019-12-23';
		 // $enddate='2019-12-29';
		  
		 $selSumcount = Contact::whereBetween('created_at', [$fromdate, $enddate])->count();
		//print_r( $selSumcount);

		if($selSumcount)
		{
			 
			 $selstates = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
						->select('contacts.state_id', 'states.name')
						->whereBetween('contacts.created_at', [$fromdate, $enddate])->get();
					
			foreach ($selstates as $selstates) 
			{
				$filename = 'WeeklyReport_from_'.$fromdate.'_to_'.$enddate.'_'.strtolower($selstates->name).'.csv';
				$csv= "Campaign Id,Campaign Name, Gift Name,Outlet Name,Distributer Name,State,City,Person Name,Mobile,Email,Created At  \n";//Column headers
				$csv_handler = fopen (public_path().'/weeklySummary/'.$filename,'w');
				
				fwrite ($csv_handler,$csv);
			}
			
				
			$selContacts = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
					->leftJoin('gifts', 'gifts.id', '=', 'contacts.gift_id')
					->leftJoin('codes', 'codes.code', '=', 'contacts.code')
					->select('contacts.*', 'states.name as state_name','gifts.gift_name',	'codes.campaign_id','codes.campaign_name')
					->whereBetween('contacts.created_at', array($fromdate, $enddate))->get();
								
			//print_r($selContacts);
			foreach ($selContacts as $selSumm1) 
			{
				$filename = 'WeeklyReport_from_'.$fromdate.'_to_'.$enddate.'_'.strtolower($selSumm1->state_name).'.csv';
				if($selSumm1->state_id==$selSumm1->state_id)
				{
					//echo '3';
					$csv2= $selSumm1->campaign_id.','.$selSumm1->campaign_name.','.$selSumm1->gift_name.
					','.$selSumm1->outlet_name.','.$selSumm1->distributor_name.','.$selSumm1->state_name.
					','.$selSumm1->city.','.$selSumm1->name.','.$selSumm1->mobile.
					','.$selSumm1->email.','.$selSumm1->created_at."\n";
				}
	 
				$csv_handler = fopen (public_path().'/weeklySummary/'.$filename,'a');
				fwrite ($csv_handler,$csv2);
				fclose ($csv_handler);	
					
			}
		
		
		}

		echo 'done';
		
	}


public function WeeklySummaryReport(Request $request)
    {


			$current_date=date('Y-m-d');
		
	
			$ts = strtotime($current_date);
			$start = (date('w', $ts) == 0) ? $ts : strtotime('last monday', $ts);
	
			 $fromdate=	date('Y-m-d', $start);
			
			 $enddate=date('Y-m-d', strtotime('next sunday', $start));
    
       			
		 $selSumcount = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
					->leftJoin('gifts', 'gifts.id', '=', 'contacts.gift_id')
					->leftJoin('codes', 'codes.code', '=', 'contacts.code')
					->select('contacts.*', 'states.name as state_name','gifts.gift_name',	'codes.campaign_id','codes.campaign_name')
					->whereBetween('contacts.created_at', [$fromdate, $enddate])->count();


		if($selSumcount)
		{
			 $selSumm1 = Contact::leftJoin('states', 'states.id', '=', 'contacts.state_id')
					->leftJoin('gifts', 'gifts.id', '=', 'contacts.gift_id')
					->leftJoin('codes', 'codes.code', '=', 'contacts.code')
					->select('contacts.*', 'states.name as state_name','gifts.gift_name',	'codes.campaign_id','codes.campaign_name')
					->whereBetween('contacts.created_at', [$fromdate, $enddate])->groupBy('contacts.state_id')->get();
					
		
		//$bsmsCount = Bsms::where('state', '=', $selSumm1->state_id)->get()->count();
		$bbstate_id=array();
		foreach ($selSumm1 as $selSumm1) 
		{
			$state=$selSumm1['state_name'];
			 $bbstate_id=$selSumm1['state_id'];
			$filename = 'WeeklyReport_from_'.$fromdate.'_to_'.$enddate.'_'.strtolower($state).'.csv';
			
			$csvattach =public_path().'/weeklySummary/'.$filename;

			$email_subject='Weekly Report -'.$state.' from '.date('d/m/Y',strtotime($fromdate)).' to '.date('d/m/Y',strtotime($enddate)).'';
		$bsmslist = Bsms::where('state', '=', $bbstate_id)->where('status', '=', '1')->get();

        	
        	          
				$bmsemailsarr=array();
        	    $rsmmailsarr=array();
				foreach($bsmslist as  $key => $value )
				{
                    //print_r($bsmslist);

						$bmstype=$value->type;
						
						if($bmstype=='1')
						{
							$bmsemails=$value->email;
							$bmsemailsarr[]=trim($bmsemails);
						}
						elseif($bmstype=='2')
						{
							$rsmemails=$value->email;
							$rsmmailsarr[]=trim($rsmemails);
						}
                        
				    	

			    }
				$anothercc=array('pallavi.bachhawat@centuryled.in');
				
				$rsmemails=array_merge($rsmmailsarr,$anothercc);
				
				 $input['state']=ucfirst(strtolower($state));
			    $input['date']=$fromdate.'_to_'.$enddate;
				
					Mail::send('email.Report',[
					     'input'=>$input

					 ], function($message) use ($bmsemailsarr,$rsmemails,$email_subject,$csvattach){
						 $message->to($bmsemailsarr,'Magik Lights');
						$message->cc($rsmemails,'Magik Lights');
				// 		 $message->bcc('monika.thakran@interactivebees.com','Magik Lights');
						 $message->subject($email_subject);
						 $message->attach($csvattach);
						 
						
					 });
				
							 

			}
		
		
		}

		echo 'done';
    

	}
	
	
	public function test(Request $request)
    {
        
            if ($_SERVER['HTTP_USER_AGENT'] != 'qrmagik')
            
            echo 'error';
                exit;
            
                    echo $email_subject='test';

	                   // $bmsemails='priyanshi@interactivebees.com';
				    	 $bmsemails=trim($bmsemails);
				    	 $message='test';
				    	 //$bmsemails='monika.thakran@interactivebees.com';
					     Mail::send('email.Report',[

						 ], function($message) use ($bmsemails,$email_subject){
							 $message->to($bmsemails,'Magik Lights');
						
							 $message->subject($email_subject);
						
							 
							
						 });
						 
						 echo 'done';
	
    }


}
