<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Event;

class EventController extends Controller
{
    public function getEvent()
    {
        $event = Event::all();
        return view('admin.event.list', ['event' => $event]);
    }
    public function Edit($id)
    {
        $event = Event::find($id);
        return view('admin.event.edit', ['event' => $event]);
    }
    public function EditPost(Request $request, $id)
    {
        $event = Event::find($id);
        if ($request->hasFile('image')) {
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'body' => 'required',
                    'image' => 'required',


                ],
                [
                    'name.required' => "Anda belum memasukkan nama acara",
                    'body.required' => "Anda tidak memasukkan konten",
                    'image.required' => "Anda belum mengimpor gambar",




                ]
            );
            if ($event->image && file_exists(storage_path('app/public/' . $event->image))) {
                if (File::exists($event)) {
                    unlink($event);
                }
            }
            $path = $request->file('image')->store('public/images');
            $event->image = $path;
        }
        $event->name = $request->name;
        $event->body = $request->body;
        $event->save();
        return redirect('admin/event/list')->with('annoucement', 'Informasi telah berhasil Update');
    }
    // public function EditPost1(Request $request, $id)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             'name' => 'required',
    //             'body' => 'required',
    //             'image' => 'required',


    //         ],
    //         [
    //             'name.required' => "Anda belum memasukkan nama acara",
    //             'body.required' => "Anda tidak memasukkan konten",
    //             'image.required' => "Anda belum mengimpor gambar",




    //         ]
    //     );

    //     $event = Event::find($id);

    //     $event->name = $request->name;
    //     $event->body = $request->body;
    //     $event->image = "images/" . $request->image->getClientOriginalName();


    //     $event->save();


    //     return redirect('admin/event/list')->with('annoucement', 'Informasi telah berhasil Update');
    // }

    public function Add()
    {
        return view('admin.event.add');
    }
    public function AddPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'body' => 'required',
                'image' => 'required',

            ],
            [
                'name.required' => "Anda belum memasukkan nama acara",
                'body.required' => "Anda belum memasukkan konten",
                'image.required' => "Anda belum memasukkan gambar",

            ]
        );
        $path = $request->file('image')->store('public/images');
        $event = new Event;
        $event->name = $request->name;
        $event->body = $request->body;
        $event->image = $path;


        $event->save();


        return redirect('admin/event/list')->with('annoucement', 'Acara sukses ditambahkan');
    }
    public function Delete($id)
    {
        $event = Event::find($id);
        $path = storage_path('app/public/' . $event->image);

        if (file_exists($path)) {
            //File::delete($image_path);
            File::delete($path);
        }
        $event->delete();
        return redirect('admin/event/list')->with('annoucement', 'Hapus acara sukses');
    }
}
