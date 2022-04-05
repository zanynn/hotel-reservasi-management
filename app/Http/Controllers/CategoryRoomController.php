<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Room;
use App\CategoryRoom;

class CategoryRoomController extends Controller
{
    public function getRoom()
    {
        $room = CategoryRoom::all();
        return view('admin.room_category.list', ['category_room' => $room]);
    }
    public function Edit($id)
    {
        //$categoryRoom=CategoryRoom::all();
        $room = CategoryRoom::find($id);
        return view('admin.room_category.edit', ['category_room' => $room]);
    }

    public function EditPost(Request $request, $id)
    {
        $room = CategoryRoom::find($id);
        if ($request->hasFile('image')) {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'price' => 'required',
                    'description' => 'required',
                ],
                [

                    'name.required' => "Anda belum memasukkan nama tipe kamar",
                    'price.required' => "Anda belum memasukkan harga tipe kamar",
                    'description.required' => "Anda belum memasukkan deskripsi tipe kamar",

                ]
            );
            if ($room->image && file_exists(storage_path('app/public/' . $room->image))) {
                if (File::exists($room)) {
                    unlink($room);
                }
            }
            $path = $request->file('image')->store('public/images');
            $room->image = $path;
        }
        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->category_wisma = $request->category_wisma;
        $room->save();
        return redirect('admin/category_room/list')->with('annoucement', 'Berhasil mengedit informasi kamar');
    }

    public function Add()
    {
        $categoryRoom = CategoryRoom::all();
        return view('admin.room_category.add', ['categoryRoom' => $categoryRoom]);
    }
    public function AddPost(Request $request)
    {
        $this->validate(
            $request,
            [

                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'

            ],
            [

                'name.required' => "Anda belum memasukkan nama tipe kamar",
                'price.required' => "Anda belum memasukkan harga tipe kamar",
                'description.required' => "Anda belum memasukkan deskripsi tipe kamar",
                'image.required' => "Anda belum mengimpor foto",

            ]
        );
        $path = $request->file('image')->store('public/images');
        $room = new CategoryRoom;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->category_wisma = $request->category_wisma;
        $room->image = $path;
        $room->save();
        return redirect('admin/category_room/list')->with('annoucement', 'berhasil menambahkan tipe kamar');
    }
    public function Delete($id)
    {
        $room = CategoryRoom::find($id);
        $path = storage_path('app/public/' . $room->image);

        if (file_exists($path)) {
            File::delete($path);
        }
        $room->delete();
        return redirect('admin/category_room/list')->with('annoucement', 'Berhasil menghapus tipe kamar');
    }
}
