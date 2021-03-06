<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\GiftAssignments;
use App\Gift;
use App\GiftTrans;
use App\state;
use App\Campaign;
class GiftController extends Controller
{
    public function listGift()
    {
        $giftlist = Gift::all();


		// $giftlist=Gift::join('giftsbycampaign', 'giftsbycampaign.gift_id', '=', 'gifts.id')
				// ->select('gifts.*',
					// 'giftsbycampaign.quantity as totgiftqty', 'giftsbycampaign.campaign_id')
				// ->get();
				
				
        return view('backend.gift', ['gifts' => $giftlist]);
    }


	public function listGiftAssignment()
    {
        //$giftlist = GiftAssignments::all();
		$giftlist = GiftAssignments::join('gifts', 'gifts.id', '=', 'giftsbycampaign.gift_id')
				->join('campaigns', 'campaigns.campaign_id', '=', 'giftsbycampaign.campaign_id')
				->select('giftsbycampaign.*', 'gifts.gift_name as gift_name',
					'gifts.quantity as totgiftqty','campaigns.campaign_name')
				->get();
        return view('backend.gcampign', ['gifts' => $giftlist]);
    }

    public function actionGift()
    {

        $Giftlist = Gift::all();
//dd($user);
        return 	view('backend.gift',['gifts'=>$Giftlist]);
    }

	public function viewEditGiftAssignment(Request $request , $id)
	{
		
		 
        $gifts = Gift::findOrFail($id);
       
		$states = State::get();
		
		$Campaign = Campaign::get();
	
        return 	view('backend.add-edit-giftAssignment',compact('gifts','Campaign'));
		
	}


	public function addGiftAssignment(Request $request , $id)
    {
        //dd($request->all());

        $Giftdata = Gift::find($id);

        $validator =Validator::make($request->all(), [
           
            'campaign_id' => 'required',
            'quantity' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('admin/gift/assigncampign/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        //update post data

        $input = $request->all();
		
		//dd($input);
		$input['gift_id']=$id;
		
		
	
	  $Giftdata=GiftAssignments::create($input);
	  
	  
      return redirect('admin/gift')->with('success', 'Gift Assigned Successfully');
    
	}
		
	
    public function statusGift(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);

        if($request->action=="Active")
        {

            foreach ($request->chkid as $id)
            {
                $Giftlist = Gift::find($id);
                $Giftlist->update(array('status' => '1'));
            }

            return redirect('admin/gift')->with('success', 'Gift Status Updated Successfully');
        }


        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $Giftlist = Gift::find($id);
                $Giftlist->update(array('status' => '0'));
            }
            return redirect('admin/gift')->with('success', 'Gift Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = Gift::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/gift')->with('success', 'Gift Delete Successfully');
        }



    }

    public function activate(Request $request,$id)
    {
        $Giftlist = Gift::find($id);
        $Giftlist->update(array('status' => '1'));
        return redirect('admin/gift')->with('success', 'Success! The Gift is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $Giftlist = Gift::find($id);
        $Giftlist->update(array('status' => '0'));
        return redirect('admin/gift')->with('success', 'Success! The Gift is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $Giftlist = Gift::findOrFail($id);
        $Giftlist->delete();
        return redirect('admin/gift')->with('success', 'Success! Gift is deleted successfully.');
    }








    public function Add()
    {
		$Campaign = Campaign::where('status','=','1')->get();
        return view('backend.add-edit-gift',compact('Campaign'));

    }
	
	

    public function AddGift(Request $request)
    {

        //dd($request->all());
        $validator =Validator::make($request->all(), [
            'gift_name' => 'required|string|max:255',
            'campaign_id' => 'required',
            'status' => 'required',
        ]);


        if($validator->fails())
        {
            return redirect('admin/gift/add/new')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
		
		
        $Giftdata=Gift::create($input);

        return redirect('admin/gift')->with('success', 'Gift Added Successfully');
    }

    public function viewEditGift(Request $request , $id)
    {
        //dd($id);
        $gifts = Gift::findOrFail($id);
		$Campaign = Campaign::get();
	
        return 	view('backend.add-edit-gift',compact('gifts','Campaign'));
    }

	
	
 public function editGift(Request $request , $id)
    {
        //dd(request()->ip());

        $Giftdata = Gift::find($id);
        $Giftrec = Gift::where('id','=',$id)->get()->first();
		
		 $prevquanity=$Giftrec->quantity;
		//dd($Giftrec);
        $validator =Validator::make($request->all(), [
            'gift_name' => 'required|string|max:255',
            'status' => 'required',
        ]);

		
        if($validator->fails())
        {
            return redirect('admin/gift/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
		
		
		
		
		$insert['gift_id']=$id;
		$insert['new_quantity']=$request->quantity;
		$insert['previous_quantity']=$prevquanity;
		$insert['user_id']=$id;
		$insert['campaign_id']=$request->campaign_id;
		$insert['ip_address']=request()->ip();
		
		
		 $Gifttrans=GiftTrans::create($insert);
		 
		 $input = $request->all();
		
		$input['gift_id']=$id;
		
		 $Giftdata->update($input);
		 
        //update post data

       
		//dd($input['state_id']);
		
	
		// if(count($input['state_id'])!='')
		// {
			// //echo $state_id;
			 // $Giftlist = GiftAssignments::findOrFail($id);
			 // //dd($Giftlist);
			 // $Giftlist->delete();
			// foreach($input['state_id'] as $key=>$values)
			// {
				// $input['state_id']=$values;
				// //dd($input);
				 // $Giftdata=GiftAssignments::create($input);
				
			// }
		// }
		// else{
	
	
			
		
		
		//}
		

        return redirect('admin/gift')->with('success', 'Gift Update Successfully');
    
	}

}
