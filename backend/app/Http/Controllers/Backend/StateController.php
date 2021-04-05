<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\State;
class StateController extends Controller
{
    public function listState()
    {
        $statelist = State::all();

        return view('backend.state', ['states' => $statelist]);
    }

    public function actionState()
    {

        $Statelist = State::all();
//dd($user);
        return 	view('backend.state',['states'=>$Statelist]);
    }


    public function statusState(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);

        if($request->action=="Active")
        {

            foreach ($request->chkid as $id)
            {
                $Statelist = State::find($id);
                $Statelist->update(array('status' => '1'));
            }

            return redirect('admin/state')->with('success', 'State Status Updated Successfully');
        }


        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $Statelist = State::find($id);
                $Statelist->update(array('status' => '0'));
            }
            return redirect('admin/state')->with('success', 'State Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = State::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/state')->with('success', 'State Delete Successfully');
        }



    }

    public function activate(Request $request,$id)
    {
        $Statelist = State::find($id);
        $Statelist->update(array('status' => '1'));
        return redirect('admin/state')->with('success', 'Success! The State is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $Statelist = State::find($id);
        $Statelist->update(array('status' => '0'));
        return redirect('admin/state')->with('success', 'Success! The State is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $statelist = State::findOrFail($id);
        $statelist->delete();
        return redirect('admin/state')->with('success', 'Success! State is deleted successfully.');
    }








    public function Add()
    {
        return view('backend.add-edit-state');

    }

    public function AddState(Request $request)
    {

        //dd($request->all());
        $validator =Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);


        if($validator->fails())
        {
            return redirect('admin/state/add/new')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $Statedata=State::create($input);

        return redirect('admin/state')->with('success', 'State Added Successfully');
    }

    public function viewEditState(Request $request , $id)
    {
        //dd($id);
        $states = State::findOrFail($id);


//dd($images);
        return 	view('backend.add-edit-state',compact('states'));
    }

    public function editState(Request $request , $id)
    {
        //dd($request->all());

        $Statedata = State::find($id);

        $validator =Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('admin/state/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        //update post data

        $input = $request->all();
        $Statedata->update($input);



        return redirect('admin/state')->with('success', 'State Update Successfully');
    }


}
