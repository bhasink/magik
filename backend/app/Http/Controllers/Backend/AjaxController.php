<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use Illuminate\Support\Facades\DB;
use Activation;
use App\Gift;
use Mail;

class AjaxController extends Controller
{
    public function getcampaign()
	{
      echo $msg = "This is a simple message.";
      return response()->json(array('msg'=> $msg), 200);
   }

    public function selectgiftByCampaign(Request $request)
    {
        //dd($request->all());

             $gifts = Gift::where('campaign_id',$request->campaign_id)->get(['gift_name','id']);
               $html='';

					$html.='<option value="">Select</option>';
                        foreach($gifts as $gift) {
                            $html .= ' <option value="'.$gift['id'].'" >'.$gift['gift_name'].'</option>';
                       }

            return $html;

    }
}
