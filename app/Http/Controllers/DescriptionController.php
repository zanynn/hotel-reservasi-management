<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Description;
class DescriptionController extends Controller
{
	public function getDescription()
	{
		$description=Description::all();
		return view('admin.description.list',['description'=>$description]);
	}
	public function edit()
	{
		$description=Description::find(1);
		return view('admin.description.edit',['description'=>$description]);
	}
	public function editPost(Request $request)
	{
		 $this->validate($request,
        [
            'room'=>'required',
            'photo'=>'required',
            'menu'=>'required',
            'event'=>'required',
            
        ],
        [
            'room.required'=>"Anda tidak memasukkan konten",
            'photo.required'=>"Anda tidak memasukkan foto",
            'menu.required'=>"Anda tidak memasukkan menu",
            'event.required'=>"Anda tidak memasukkan event",
            
           

        ]);
        
        $description=Description::find(1);
        $description->room=$request->room;
        $description->photo=$request->photo;
        $description->menu=$request->menu;
        $description->event=$request->event;

        $description->save(); 


        return redirect('admin/description/list')->with('annoucement','Edit informasi berhasil');
      
	}
}
