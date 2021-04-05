<?php
namespace App\Http\Controllers\Backend;
use App\City;
use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Contact;
use DB;

class ContactController extends Controller
{
    public function listContact()
    {

// dd('hgh');
      

        // $contacts = Contact::where('status', '=',1)->get();
        $contacts = Contact::select("contacts.*", "gifts.gift_name","codes.campaign_id","codes.qr_id","codes.campaign_name","states.name as state_name")
        ->leftjoin("gifts", "gifts.id", "=", "contacts.gift_id")
        ->leftjoin("states", "states.id", "=", "contacts.state_id")
        
		->leftjoin("codes", "codes.code", "=", "contacts.code")
		->where('contacts.status', '=', '1')->get();



        return \View::make('backend.contact',compact('contacts'));

    }
    public function statusContact(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);

        if($request->action=="Active")
        {

            foreach ($request->chkid as $id)
            {
                $Contactlist = Contact::find($id);
                $Contactlist->update(array('status' => '1'));
            }

            return redirect('admin/contact')->with('success', 'Contact Status Updated Successfully');
        }


        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $Citylist = Contact::find($id);
                $Citylist->update(array('status' => '0'));
            }
            return redirect('admin/city')->with('success', 'Contact Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = Contact::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/contact')->with('success', 'Contact Delete Successfully');
        }



    }

    public function activate(Request $request,$id)
    {
        $Contactlist = Contact::find($id);
        $Contactlist->update(array('status' => '1'));
        return redirect('admin/city')->with('success', 'Success! The Contact is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $Contactlist = Contact::find($id);
        $Contactlist->update(array('status' => '0'));
        return redirect('admin/contact')->with('success', 'Success! The Contact is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $Contactlist = Contact::findOrFail($id);
        $Contactlist->delete();
        return redirect('admin/contact')->with('success', 'Success! Contact is deleted successfully.');
    }


    public function viewEditContact(Request $request , $id)
    {
        $contacts = Contact::findOrFail($id);
        return 	view('backend.add-edit-contact',compact('contacts'));
    }

    public function editContact(Request $request , $id)
    {
        //dd($request->all());

        $Contactdata = Contact::find($id);

        $validator =Validator::make($request->all(), [
            'delivery' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('admin/contact/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        //update post data

        $input = $request->all();
        $Contactdata->update($input);



        return redirect('admin/contact')->with('success', 'Contact Update Successfully');
    }



    public function AddConatact(Request $request)
    {
        return 'Hello';
    }
}
