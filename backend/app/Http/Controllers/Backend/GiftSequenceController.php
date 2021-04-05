<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\GiftAssignments;
use App\Gift;
use App\GiftbySequence;
use App\GiftTrans;
use App\state;
use App\Campaign;
class GiftSequenceController extends Controller
{
    
    
    public function listGiftSequence()
    {
        $giftlist = GiftbySequence::all();


		$giftlist=Gift::select('giftsequenceassignment.id as assseqid','gifts.id','gifts.gift_name','gifts.quantity','giftsequenceassignment.serialno','giftsequenceassignment.campaign_id','campaigns.campaign_name','giftsequenceassignment.created_at')
		    
		    ->join('giftsequenceassignment', 'giftsequenceassignment.giftid', '=', 'gifts.id')
		    ->join('campaigns', 'campaigns.campaign_id', '=', 'giftsequenceassignment.campaign_id')
		   ->where( 'campaigns.status', '=','1')
			
				->get();
				
				
				
        return view('backend.giftSequence', ['gifts' => $giftlist]);
    }


    public function Add()
    {
		$Campaign = Campaign::where('status','=','1')->get();
		$Giftlist = Gift::where('status','=','1')->get();
        return view('backend.add-edit-giftsequence',compact('Campaign','Giftlist'));

    }
	

     public function AddGiftSequence(Request $request)
    {

       // dd($request->all());
        $validator =Validator::make($request->all(), [
            'gift_id' => 'required',
            'campaign_id' => 'required',
            'sequence_no' => 'required',
           
        ]);

	
        if($validator->fails())
        {
            return redirect('admin/giftsequence/add/new')
                ->withErrors($validator)
                ->withInput();
        }
		$sequence=$request->sequence_no;
		
		foreach($sequence as $key=>$value)
		{
			
			$input['serialno']=$value;
			$input['giftid']=$request->gift_id;
			$input['campaign_id']=$request->campaign_id;
			$Giftdata=GiftbySequence::create($input);
		}
		
      
       return redirect('admin/giftsequence')->with('success', 'Gift Sequence Added Successfully');
    }

	public function viewEditGiftSequence(Request $request , $id)
	{
		
		 
        $gifts = GiftbySequence::findOrFail($id);
   
 
         //dd($gifts);

	    $Campaign = Campaign::where('status','=','1')->where('campaign_id','=',$gifts->campaign_id)->get();
		$Giftlist = Gift::where('status','=','1')->where('campaign_id','=',$gifts->campaign_id)->get();
		
		
        return view('backend.add-edit-giftsequence',compact('Campaign','Giftlist','gifts'));
		
	}
	
 public function editGiftSequence(Request $request , $id)
    {
       //dd(request()->all());

        $Giftdata = GiftbySequence::find($id);
      
        $validator =Validator::make($request->all(), [
            'gift_id' => 'required',
            'campaign_id' => 'required',
            'sequence' => 'required',
           
        ]);

		
        if($validator->fails())
        {
            return redirect('admin/giftsequence/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
		
		
	
		
	
		
		  	$input['serialno']=$request->sequence;
			$input['giftid']=$request->gift_id;
			$input['campaign_id']=$request->campaign_id;
			
		
		 $Giftdata->update($input);
		 
	

        return redirect('admin/giftsequence')->with('success', 'Gift Sequence Updated Successfully');
    
	}


    public function actionGift()
    {

        $Giftlist = Gift::all();
//dd($user);
        return 	view('backend.gift',['gifts'=>$Giftlist]);
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






	

   

}
