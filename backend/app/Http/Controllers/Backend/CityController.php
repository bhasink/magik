<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Sentinel;
use App\User;
use App\City;
use App\State;
class CityController extends Controller
{
    public function listCity()
    {
        $listCity = City::all();

        return view('backend.city', ['cities' => $listCity]);
    }

    public function actionCity()
    {

        $Citylist = City::all();
//dd($user);
        return 	view('backend.city',['cities'=>$Citylist]);
    }


    public function statusCity(Request $request)
    {
        //dd(count($request->chkid));
        //dd($request->action);

        if($request->action=="Active")
        {

            foreach ($request->chkid as $id)
            {
                $Citylist = City::find($id);
                $Citylist->update(array('status' => '1'));
            }

            return redirect('admin/city')->with('success', 'City Status Updated Successfully');
        }


        if($request->action=="Inactive")
        {
            foreach ($request->chkid as $id)
            {
                $Citylist = City::find($id);
                $Citylist->update(array('status' => '0'));
            }
            return redirect('admin/city')->with('success', 'City Status Updated Successfully');
        }

        if($request->action=="Delete")
        {
            $delete = City::whereIn('id', $request->chkid)->delete();
            //dd($dues);
            return redirect('admin/city')->with('success', 'City Delete Successfully');
        }



    }

    public function activate(Request $request,$id)
    {
        $Citylist = City::find($id);
        $Citylist->update(array('status' => '1'));
        return redirect('admin/city')->with('success', 'Success! The City is activated successfully.');
    }

    public function deactivate(Request $request,$id){
        $Citylist = City::find($id);
        $Citylist->update(array('status' => '0'));
        return redirect('admin/city')->with('success', 'Success! The City is deactivated successfully.');
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        $Citylist = City::findOrFail($id);
        $Citylist->delete();
        return redirect('admin/city')->with('success', 'Success! City is deleted successfully.');
    }








    public function Add()
    {
        $states=State::where('status','=','1')->get();
        return view('backend.add-edit-city',compact('states'));

    }

    public function AddCity(Request $request)
    {

        //dd($request->all());
        $validator =Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);


        if($validator->fails())
        {
            return redirect('admin/city/add/new')
                ->withErrors($validator)
                ->withInput();
        }

        $input = $request->all();
        $Citydata=City::create($input);

        return redirect('admin/city')->with('success', 'City Added Successfully');
    }

    public function viewEditCity(Request $request , $id)
    {
        $cities = City::findOrFail($id);
        $states=State::where('status','=','1')->get();
        return 	view('backend.add-edit-city',compact('cities','states'));
    }

    public function editCity(Request $request , $id)
    {
        //dd($request->all());

        $Citydata = City::find($id);

        $validator =Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required',
        ]);

        if($validator->fails())
        {
            return redirect('admin/city/edit/'.$id)
                ->withErrors($validator)
                ->withInput();
        }
        //update post data

        $input = $request->all();
        $Citydata->update($input);



        return redirect('admin/city')->with('success', 'City Update Successfully');
    }


}
