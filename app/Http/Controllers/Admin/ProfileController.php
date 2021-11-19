<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Exception;

use Illuminate\Foundation\Validation\ValidatesRequests;

class ProfileController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $data = Profile::latest()->first();
        return view('profile.index',compact('data'));
    }

    public function update(Request $request)
    {
        $messages = [
            'required' => 'Kolom Wajib diisi!',
            'image.mimes'                         => 'Format gambar harus jpeg, png, jpg, gif, svg!',
            'image.max'                           => 'Ukuran gambar harus di bawah 2MB!',
        ];

        $this->validate($request, [
            'image'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'title' => 'required',
            'content' => 'required',
        ], $messages);

        $update =Profile::findOrFail($request->id);
        if ($request->file('image')) {
            $tujuan_upload = "profile";
            $image = $request->file('image');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->image = $nama_file;
        }
        $update->title = $request->get('title');
        $update->content = $request->get('content');
        $update->save();
        if ($update) {
            //redirect dengan pesan sukses
            return redirect()->route('profile.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('profile.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

}
