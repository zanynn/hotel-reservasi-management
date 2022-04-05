<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\About;

class AboutController extends Controller
{
    public function getAbout()
    {
        $about = About::all();
        return view('admin.about.list', ['about' => $about]);
    }
    public function edit()
    {
        $about = About::find(1);
        return view('admin.about.edit', ['about' => $about]);
    }
    public function editPost(Request $request)
    {
        $about = ABout::find(1);
        if ($request->hasFile('image')) {
            $this->validate(
                $request,
                [
                    'body' => 'required',
                    'image' => 'required',
                    'video' => 'required',


                ],
                [
                    'body.required' => "Anda belum memasukkan konten",
                    'image.required' => "Anda tidak memasukkan gambar",
                    'video.required' => "Anda belum mengimpor video",




                ]
            );
            if ($about->image && file_exists(storage_path('app/public/' . $about->image))) {
                if (File::exists($about)) {
                    unlink($about);
                }
            }
            $path = $request->file('image')->store('public/images');
            $about->image = $path;
        }
        $about->body = $request->body;
        $about->video = $request->video;
        $about->save();
        return redirect('admin/about/list')->with('annoucement', 'Edit informasi hotel berhasil');
    }
}
