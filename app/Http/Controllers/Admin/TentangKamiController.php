<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class TentangKamiController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $data = TentangKami::latest()->first();
        return view('tentangkami.index',compact('data'));
    }

    public function update(Request $request)
    {
        $messages = [
            'required' => 'Kolom Wajib diisi!',
            'image.mimes'                         => 'Format gambar harus jpeg, png, jpg, gif, svg!',
            'image.max'                           => 'Ukuran gambar harus di bawah 2MB!',
        ];

        $this->validate($request, [

            'logo'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'title_section_one' => 'required',
            'description_section_one' => 'required',
            'title_section_two' => 'required',
            'description_section_two' => 'required',
            'link_video' => 'required',
            'image_visi'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'content_visi' => 'required',
            'image_misi'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'content_misi' => 'required',
            'alamat' => 'required',
            'google_map' => 'required',
            'kontak' => 'required',
        ], $messages);

        $update =TentangKami::findOrFail($request->id);
        if ($request->file('logo')) {
            $tujuan_upload = "profile";
            $image = $request->file('logo');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->logo = $nama_file;
        }
        $update->title_section_one = $request->get('title_section_one');
        $update->description_section_one = $request->get('description_section_one');
        $update->title_section_two = $request->get('title_section_two');
        $update->description_section_two = $request->get('description_section_two');
        $update->link_video = $request->get('link_video');
        if ($request->file('image_visi')) {
            $tujuan_upload = "profile";
            $image = $request->file('image_visi');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->image_visi = $nama_file;
        }
        $update->content_visi = $request->get('content_visi');
        if ($request->file('image_misi')) {
            $tujuan_upload = "profile";
            $image = $request->file('image_misi');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->image_misi = $nama_file;
        }
        $update->content_misi = $request->get('content_misi');
        $update->alamat = $request->get('alamat');
        $update->google_map = $request->get('google_map');
        $update->kontak = $request->get('kontak');
        $update->facebook = $request->get('facebook');
        $update->instagram = $request->get('instagram');
        $update->save();
        if ($update) {
            //redirect dengan pesan sukses
            return redirect()->route('tentangkami.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('tentangkami.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }



}
