<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Slide;

class SlideController extends Controller
{
    public function getSlide()
    {
        $slide = Slide::all();
        return view('admin.slide.list', ['slide' => $slide]);
    }
    public function Edit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit', ['slide' => $slide]);
    }
    // public function EditPost(Request $request, $id)
    // {
    //     $rules = [
    //         'link' => 'required',
    //         'caption' => 'required'
    //     ];
    //     $validatedData = $request->validate($rules);
    //     $image = $validatedData['link'];
    //     if ($image) {
    //         // cek file yang ada didatabase apakah terdapat gambar / tidak, jika ada hapus
    //         if ($request->old_file) {
    //             File::delete(public_path($request->old_file));
    //         }
    //         // menyimpan data file yang diupload ke variabel $file
    //         $image_name =  time() . "-" . $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();
    //         // isi dengan nama folder tempat kemana file diupload
    //         $path = public_path('/information/slide/');
    //         File::makeDirectory($path, $mode = 0777, true, true);
    //         $image->move($path, $image_name);
    //         $image = '/information/slide/' . $image_name;
    //     }
    //     $validatedData['link'] = $request->link;
    //     $validatedData['caption'] = $request->caption;
    //     Slide::where('id', $id)->update($validatedData);
    //     return redirect('admin/slide/list')->with('annoucement', 'Informasi slide berhasil diedit');
    // }
    public function EditPost(Request $request, $id)
    {
        $slide = Slide::find($id);
        if ($request->hasFile('link')) {
            $request->validate([
                'link' => 'required',
            ]);

            if ($slide->link && file_exists(storage_path('app/public/' . $slide->link))) {
                if (File::exists($slide)) {
                    unlink($slide);
                }
            }
            $path = $request->file('link')->store('public/images');
            $slide->link = $path;
        }
        $slide->caption = $request->caption;
        $slide->save();
        return redirect('admin/slide/list')->with('annoucement', 'Informasi slide berhasil diedit');
    }
    // public function EditPost(Request $request, $id)
    // {
    //     $this->validate(
    //         $request,
    //         [

    //             'caption' => 'required',

    //         ],
    //         [

    //             'caption.required' => "Anda belum memasukkan keterangan gambar",

    //         ]
    //     );

    //     $slide = Slide::find($id);
    //     // $slide->link=$request->link;
    //     $slide->caption = $request->caption;
    //     $slide->link = "images/" . $request->image->getClientOriginalName();


    //     $slide->save();


    //     return redirect('admin/slide/list')->with('annoucement', 'Informasi slide berhasil diedit');
    // }

    public function Add()
    {
        return view('admin.slide.add');
    }
    public function AddPost(Request $request)
    {
        $request->validate([
            'link' => 'required',
            'caption' => 'required',
        ]);
        $path = $request->file('link')->store('public/images');
        $slide = new Slide;
        $slide->link = $path;
        $slide->caption = $request->caption;
        $slide->save();
        return redirect('admin/slide/list')->with('annoucement', 'Berhasil menambahkan slide');
    }
    // public function AddPost(Request $request)
    // {
    //    $this->validate($request,
    //     [
    //         'link'=>'required',
    //         'caption'=>'required',

    //     ],
    //     [   
    //         'link.required'=>"Anda belum memasukkan tautan gambar",
    //         'caption.required'=>"Anda belum memasukkan keterangan gambar",

    //     ]);

    //     $slide=new Slide;
    //     $slide->link=$request->link;
    //     $slide->caption=$request->caption;



    //     $slide->save(); 


    //     return redirect('admin/slide/list')->with('annoucement','Berhasil menambahkan slide');

    // }
    public function Delete($id)
    {
        $slide = Slide::find($id);
        $path = storage_path('app/public/' . $slide->link);

        if (file_exists($path)) {
            //File::delete($image_path);
            File::delete($path);
        }
        $slide->delete();
        return redirect('admin/slide/list')->with('annoucement', 'Hapus slide dengan sukses');
    }
}
