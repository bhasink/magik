<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\Bsm;
class BsmController extends Controller
{
    public function listBsm()
    {
        $bsmlist = Bsm::all();

        return view('backend.bsm', ['bsms' => $bsmlist]);
    }

    public function actionBsm()
    {

        $Bsmlist = Bsm::all();
//dd($user);
        return 	view('backend.bsm',['bsms'=>$Bsmlist]);
    }


    public function statusBsm(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);

        if($request->action=="Active")
        {

            foreach ($request->chkid as $id)
            {
                $Bsmlist = Bsm::find($id);
                $Bsmlist->update(array('status' => '1'));
            }

            return redirect('admin/bsm')->with('success', 'Bsm Status Updated Successfully');
        }


        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $Bsmlist = Bsm::find($id);
                $Bsmlist->update(array('status' => '0'));
            }
            return redirect('admin/bsm')->with('success', 'Bsm Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = Bsm::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/bsm')->with('success', 'Gift Delete Successfully');
        }



    }

    public function activate(Request $request,$id)
    {
        $Bsmlist = Bsm::find($id);
        $Bsmlist->update(array('status' => '1'));
        return redirect('admin/bsm')->with('success', 'Success! The Bsm is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $Bsmlist = Bsm::find($id);
        $Bsmlist->update(array('status' => '0'));
        return redirect('admin/bsm')->with('success', 'Success! The Bsm is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $Bsmlist = Bsm::findOrFail($id);
        $Bsmlist->delete();
        return redirect('admin/bsm')->with('success', 'Success! Bsm is deleted successfully.');
    }








    public function Add()
    {
        return view('backend.add-edit-bsm');

    }

    public function AddBsm(Request $request)
    {

       // dd($request->all());
        $validator =Validator::make($request->all(), [
            'email' => 'required',
            'status' => 'required',
        ]);


        if($validator->fails())
        {
            return redirect('admin/bsm/add/new')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $Bsmdata=Bsm::create($input);

        return redirect('admin/bsm')->with('success', 'Bsm Added Successfully');
    }

    public function viewEditBsm(Request $request , $id)
    {
        //dd($id);
        $bsms = Bsm::findOrFail($id);


//dd($images);
        return 	view('backend.add-edit-bsm',compact('bsms'));
    }

    public function editBsm(Request $request , $id)
    {
        //dd($request->all());

        $Bsmdata = Bsm::find($id);

        $validator =Validator::make($request->all(), [
            'bsm' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('admin/bsm/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        //update post data

        $input = $request->all();
        $Bsmdata->update($input);



        return redirect('admin/bsm')->with('success', 'Bsm Update Successfully');
    }


}
