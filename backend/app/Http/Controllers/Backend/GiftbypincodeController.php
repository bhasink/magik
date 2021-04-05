<?php
namespace App\Http\Controllers\Backend;
use App\Campaign;
use App\Gift;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Giftbypincode;
class GiftbypincodeController extends Controller
{
    public function listGpin()
    {
        //$gpinlist = Giftbypincode::all();
		
		$gpinlist = Giftbypincode::join('states', 'states.id', '=', 'giftbypincodes.state')
				->join('gifts', 'gifts.id', '=', 'giftbypincodes.gift_id')
				->join('campaigns', 'campaigns.campaign_id', '=', 'giftbypincodes.campaign_id')
				->select('giftbypincodes.*', 'states.name as state_name','gifts.gift_name as gift_name',
					'gifts.quantity as totgiftqty','campaigns.campaign_name')
				->get();

        return view('backend.gpin', ['gpins' => $gpinlist]);
    }

    public function actionGpin()
    {

        $Gpinlist = Giftbypincode::all();
//dd($user);
        return 	view('backend.gpin',['gpins'=>$Gpinlist]);
    }


    public function statusGpin(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);

        if($request->action=="Active")
        {

            foreach ($request->chkid as $id)
            {
                $Gpinlist = Giftbypincode::find($id);
                $Gpinlist->update(array('status' => '1'));
            }

            return redirect('admin/gstate')->with('success', 'Gift By Pincode Status Updated Successfully');
        }


        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $Gpinlist = Giftbypincode::find($id);
                $Gpinlist->update(array('status' => '0'));
            }
            return redirect('admin/gstate')->with('success', 'Gift By Pincode Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = Giftbypincode::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/gstate')->with('success', 'Gift By Pincode Delete Successfully');
        }



    }

    public function activate(Request $request,$id)
    {
        $Gpinlist = Giftbypincode::find($id);
        $Gpinlist->update(array('status' => '1'));
        return redirect('admin/gstate')->with('success', 'Success! The Gift By Pincode is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $Gpinlist = Giftbypincode::find($id);
        $Gpinlist->update(array('status' => '0'));
        return redirect('admin/gstate')->with('success', 'Success! The Gift By Pincode is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $Gpinlist = Giftbypincode::findOrFail($id);
        $Gpinlist->delete();
        return redirect('admin/gstate')->with('success', 'Success! Gift By Pincode is deleted successfully.');
    }



    public function Add()
    {
	
        $gifts= Gift::where('status','=','1')->where('type','=','1')->get();
      
        $states = State::where('status','=','1')->get();
        $campaign = Campaign::where('status','=','1')->get();
		
        return view('backend.add-gpin',compact('gifts','states','campaign'));
    }

    public function AddGpin(Request $request)
    {

       
        $validator =Validator::make($request->all(), [
            'gift_id' => 'required',
            'quantity' => 'required',
            'state' => 'required',
            'status' => 'required',
        ]);

		
        if($validator->fails())
        {
            return redirect('admin/gstate/add/new')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
		
        $Giftdata=Giftbypincode::create($input);
		//dd($Giftdata);
        return redirect('admin/gstate')->with('success', 'Gift By State Added Successfully');
    }

    public function viewEditGpin(Request $request , $id)
    {
        //dd($id);
        $gifts= Gift::where('status','=','1')->where('type','=','1')->get();
        $campaign = Campaign::where('status','=','1')->get();
        $states = State::where('status','=','1')->get();
		
        $gpins = Giftbypincode::findOrFail($id);


//dd($images);
        return 	view('backend.add-edit-gpin',compact('gpins','gifts','campaign','states'));
    }

    public function editGpin(Request $request , $id)
    {
       
        $Bsmdata = Giftbypincode::find($id);

        $validator =Validator::make($request->all(), [
            'gift_id' => 'required',
            'status' => 'required',
        ]);

		 if($validator->fails())
        {
            return redirect('admin/gstate/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
		else{
			 $gifts= Gift::where('id','=',$request->gift_id)->get()->first();
			
			
			if($gifts->quantity >= $request->quantity)
			{
				 //update post data

				$input = $request->all();
				// dd($input);
				$Bsmdata->update($input);

				
			}
			else
			{
					return redirect('admin/gstate/edit/'.$id)
					->with('Errors', 'Can Not Assign Greater Values!!');
				   
			}
		}

       
        return redirect('admin/gstate')->with('success', 'Gift By State Updated Successfully');
    }
	
	
	


}
