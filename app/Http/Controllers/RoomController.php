<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Room;
use App\CategoryRoom;
class RoomController extends Controller
{
	public function getRoom()
	{
		$room=Room::all();
		return view('admin.room.list',['room'=>$room]);
	}
	public function Edit($id)
	{
        $categoryRoom=CategoryRoom::all();
		$room=Room::find($id);
		return view('admin.room.edit',['room'=>$room,'categoryRoom'=>$categoryRoom]);
	}
	public function EditPost(Request $request,$id)
	{
		$this->validate($request,
        [
            
            'name'=>'required',
            'idCategory'=>'required',
            'status'=>'required',
            
        ],
        [   
            
            'name.required'=>"Anda belum memasukkan nama ruangan",
            'idCategory.required'=>"Anda belum memasukkan tipe kamar",
            'status.required'=>"Anda belum memasukkan status kamar",
           
        ]);
        
        $room=Room::find($id);
       // $room->link=$request->link;
        $room->name=$request->name;
        $room->idCategory=$request->idCategory;
        $room->Status=$request->status;
      
       
    
        $room->save(); 


        return redirect('admin/room/list')->with('annoucement','Berhasil mengedit informasi kamar');
      
	}

    public function Add()
    {
        $categoryRoom=CategoryRoom::all();
        return view('admin.room.add',['categoryRoom'=>$categoryRoom]);
    }
    public function AddPost(Request $request)
    {
      $this->validate($request,
        [
            
            'name'=>'required',
            'idCategory'=>'required',
            'status'=>'required',
            
        ],
        [   
            
            'name.required'=>"Anda belum memasukkan nama ruangan",
            'idCategory.required'=>"Anda belum memasukkan tipe kamar",
            'status.required'=>"Anda belum memasukkan status kamar",
           
        ]);
        
        $room=new Room;
       // $room->link=$request->link;
        $room->name=$request->name;
        $room->idCategory=$request->idCategory;
        $room->Status=$request->status;
      
       
    
        $room->save(); 


        return redirect('admin/room/list')->with('annoucement','Berhasil menambahkan kamar');
      
      
    }
    public function Delete($id)
    {
        $room=Room::find($id);
        $room->delete();
        return redirect('admin/room/list')->with('annoucement','Hapus kamar berhasil');
     }

}
