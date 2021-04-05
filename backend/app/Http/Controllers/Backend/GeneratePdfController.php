<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Code;
use App\Campaign;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class GeneratePdfController extends Controller
{
    public function viewgeneratePDFbyChunks($id)
    {
		$qr =  Code::where('status', '=',1)->where('campaign_id', '=',$id)->get();
		
		$campaign =  Campaign::where('status', '=',1)->where('campaign_id', '=',$id)->first();
		
		
		
//dd($images);
        return 	view('backend.print_qrcode',compact('qr','camp_id','campaign'));
		
		//loadView('backend.print_qrcode.blade');
		
    }
	
	
	public function printQrCode(Request $request,$id)
	{
		
		 $limit = $request->q_code;
		
		$arlimit=explode('-',$limit);
		
		$start=$arlimit[0];
		$end=$arlimit[1];
		//$camp_id=$id;
		
       
         $title='QR Code Generator';

        $qr = Code::where('status', '=',1)->where('campaign_id', '=',$id)->get();
       //PDF::setPaper('a5', 'lan');
	   //PDF::setOptions(['dpi' => 72, 'defaultFont' => 'sans-serif']);
	   
		$customPaper = array(0,0,567.00,283.80);
		//$pdf = PDF::loadView('pdf.retourlabel', compact('retour','barcode'))->setPaper($customPaper, 'landscape');
		
		
		$pdf =  PDF::loadView('backend.myChunkPDF',compact('title','qr','start','end'));
		
		//
		//return view('backend.myChunkPDF',compact('title','qr','start','end'));
				   
        return $pdf->download(date('Y-m-d').'-qrcode.pdf');
	}
	
	


}
