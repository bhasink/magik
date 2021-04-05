<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use App\User;
/**
 * Class LoginController
 * @package App\Http\Controllers\Backend
 */

class LoginController extends Controller
{



    public function index()
    {

        if(Sentinel::check())
        {
            return redirect('admin/dashboard');
        }

        return \View::make('backend.login');
    }


    public function postLogin(Request $request)
    {

try
{
    //dd($request->all());
    $validator =Validator::make($request->all(), [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6',
    ]);



    if($validator->fails())
    {
        return redirect('admin/login')
            ->withErrors($validator)
            ->withInput();
    }

        $user = Sentinel::authenticate($request->all());

        //dd(Sentinel::check());

        if(Sentinel::check())
        {
            return redirect('admin/dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Wrong Credentials']);
        }
        /*
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug=='admin')
        {
            return redirect('/');
        }
        elseif(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug=='manager')
        {
            return redirect('./task');
        }
        else
        {
            return redirect()->back()->with(['error'=>'Wrong Credentials']);
        }
        */
}
catch(ThrottlingException $exception)
{
$delay=$exception->getDelay();
    return redirect()->back()->with(['error'=>"You are banned for $delay Seconds"]);
}






    }


    public function logout()
    {
        Sentinel::logout();
        return redirect('admin/login');
    }
}