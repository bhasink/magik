<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{

    public function generate(Request $request, $size = 150, $url = 'https://www.magiklights.com/ledpedia/detail.php?Drawing-Room')
    {

        $today1 = date("YmdHi");
            $rand1 = sprintf("%04d", mt_rand(1, time()));
            $QRCodeID = 'MAGIK' . $today1 . $rand1;

        \QrCode::size(150)
            ->format('png')->size(150)           
            ->generate($url, public_path('images/'.$QRCodeID.'.png'));

        /*$to_address='santosh.k.sant@gmail.com';
        $subject='Testing';
        //$body=QrCode::size($size)->generate($url);
        $body='Body of the message';
        $number='9810729466';
        $message='Body of the message';

        QrCode::SMS($number, $message);
        QrCode::phoneNumber($number);
        QrCode::email($to_address, $subject, $body);*/



        return view('FrontEnd.welcome',compact('url','size'));

    }
	
	
}
