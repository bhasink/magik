<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Code;
use App\Campaign;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function listQrCode()
    {
         $qrcodelist = Code::join('campaigns', 'campaigns.campaign_id', '=', 'codes.campaign_id')
				->select('codes.*','campaigns.campaign_name')
			
            ->where('campaigns.status','=','1')->orderBy('created_at', 'desc')->get();

        return view('backend.qrcode', ['qrcodes' => $qrcodelist]);
    }


    public function listQrCodePrint()
    {
        $qrcodelist = Campaign::where('status','=', '1')->get();

        return view('backend.qrcode-print', ['qrcodes' => $qrcodelist]);
    }

    public function actionQrCode()
    {

        $QrCodelist = Code::all();
//dd($user);
        return 	view('backend.qrcode',['qrcodes'=>$QrCodelist]);
    }


    public function statusQrCode(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);
        if($request->action=="Active")
        {
            foreach ($request->chkid as $id)
            {
                $QrCodelist = Code::find($id);
                $QrCodelist->update(array('status' => '1'));
            }
            return redirect('admin/qrcode')->with('success', 'QrCode Status Updated Successfully');
        }

        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $QrCodelist = Code::find($id);
                $QrCodelist->update(array('status' => '0'));
            }
            return redirect('admin/qrcode')->with('success', 'QrCode Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = Code::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/qrcode')->with('success', 'QrCode Delete Successfully');
        }
    }

    public function activate(Request $request,$id)
    {
        $QrCodelist = Code::find($id);
        $QrCodelist->update(array('status' => '1'));
        return redirect('admin/qrcode')->with('success', 'Success! The QrCode is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $QrCodelist = Code::find($id);
        $QrCodelist->update(array('status' => '0'));
        return redirect('admin/qrcode')->with('success', 'Success! The QrCode is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $QrCodelist = Code::findOrFail($id);
        $QrCodelist->delete();
        return redirect('admin/qrcode')->with('success', 'Success! QrCode is deleted successfully.');
    }



    public function Add()
    {
        return view('backend.add-edit-qrcode');
    }

    public function AddQrCode(Request $request)
    {
        //dd($request->all());
        $validator =Validator::make($request->all(), [
            'quantity' => 'required|string|max:255',
            'status' => 'required',
        ]);


        if($validator->fails())
        {
            return redirect('admin/qrcode/add/new')
                ->withErrors($validator)
                ->withInput();
        }


        $today = date("YmdHi");
        $rand = sprintf("%04d",  mt_rand(1, time()));
        $campaign=$today . $rand;

        $inputs['campaign_id'] = $campaign;
        $inputs['campaign_name'] = $request->campaign_name;
        $inputs['quantity'] = $request->quantity;
        $inputs['status'] = $request->status;
        $inputs['batch_size'] = $request->batch_size;
         $inputs['type'] = $request->type;
        $CampaignData=Campaign::create($inputs);




        for ($j = 0; $j < $request->quantity; $j++) {

            $today1 = date("YmdHi");
            $rand1 = sprintf("%04d", mt_rand(1, time()));
            $QRCodeID = 'MAGIK' . $today1 . $rand1;

            $size = 150;
            $url = 'https://www.magiklights.com/qrcode/'.$QRCodeID;

            \QrCode::size(150)
            ->format('png')->size(150)           
            ->generate($url, public_path('images/'.$QRCodeID.'.png'));

            //$input = $request->all();
            $input['code'] = $QRCodeID;
            $input['campaign_id'] = $campaign;
            $input['campaign_name'] = $request->campaign_name;
            $input['scan'] = 0;
            $input['image'] =$QRCodeID.'.png';
            $input['qr_id'] = "ML".$rand1;
            $input['status'] = $request->status;
            $QrCodedata = Code::create($input);

        }


        return redirect('admin/qrcode')->with('success', 'QrCode Added Successfully');
    }

    public function viewEditQrCode(Request $request , $id)
    {
        //dd($id);
        $qrcodes = Code::findOrFail($id);


//dd($images);
        return 	view('backend.add-edit-qrcode',compact('qrcodes'));
    }

    public function editQrCode(Request $request , $id)
    {
        //dd($request->all());

        $QrCodedata = Code::find($id);

        $validator =Validator::make($request->all(), [
            'code' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('admin/qrcode/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        //update post data

        $input = $request->all();
        $QrCodedata->update($input);



        return redirect('admin/qrcode')->with('success', 'QrCode Update Successfully');
    }

}
