<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Information;
class InformationController extends Controller
{
	public function getInformation()
	{
		$information=Information::all();
		return view('admin.information.list',['information'=>$information]);
	}
	public function edit()
	{
		$information=Information::find(0);
		return view('admin.information.edit',['information'=>$information]);
	}
	public function editPost(Request $request)
	{
		 $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required',
            'phone_number'=>'required',
            'slogan'=>'required',
            'address'=>'required',
            
        ],
        [
            'name.required'=>"Anda belum memasukkan nama Anda",
            'email.required'=>"Anda belum memasukkan email Anda",
            'phone_number.required'=>"Anda tidak memasukkan nomor telepon",
            'slogan.required'=>"Anda belum memasukkan slogan",
            'address.required'=>"Anda tidak memasukkan alamat",
           

        ]);
        
        $information=Information::find(0);
        $information->name=$request->name;
        $information->email=$request->email;
        $information->phone_number=$request->phone_number;
        $information->slogan=$request->slogan;
        $information->address=$request->address;    
        $information->save(); 


        return redirect('admin/information/list')->with('annoucement','Informasi hotel berhasil diedit');
      
	}
}
