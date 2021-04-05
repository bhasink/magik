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


class HomeController extends Controller
{
    public function generatePDF($id)
    {

       
        $title='QR Code Generator';

        $qr = Code::where('status', '=',1)->where('campaign_id', '=',$id)->get();
        
       
        // $pdf = PDF::loadView('backend.generateQrPDF',compact('title','qr'));
      $pdf = PDF::loadView('backend.background_image_myPDF',compact('title','qr'));
        
  
         //return $pdf->stream(date('Y-m-d').'-qrcode.pdf')
            //   ->header('Content-Type','application/pdf');
      return $pdf->stream(date('Y-m-d').'-qrcode.pdf');
       
        
    }
    
    


}
