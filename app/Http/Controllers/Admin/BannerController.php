<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infobanner;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;
    public function data(){
        try{
            $data = Infobanner::all();
            return datatables()->of($data)
            ->addColumn('banner_', function ($data) {
                if($data->type == 'image'){
                    $url= asset('photo_banner/'.$data->banner);
                    return '<img src="'.$url.'" border="0" width="150" class="img-rounded" align="center" />';
                }else{
                    $url= asset('photo_banner/'.$data->banner);
                    return '<video width="320" height="240" autoplay>
                    <source src="'.$url.'" type="video/mp4"></video>';
                }

            })
            ->addIndexColumn()
            ->rawColumns(['banner_'])
            ->make(true);
        } catch (Exception $e) {
            DB::commit();
            return response()->json(
                [
                    'status' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
    public function index()
    {
        return view('banner.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Kolom Wajib diisi!',
            // 'banner.mimes'                         => 'Format gambar harus jpeg, png, jpg, gif, svg!',
            // 'banner.max'                           => 'Ukuran gambar harus di bawah 2MB!',
        ];

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            // 'banner'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ], $messages);

        $save = new Infobanner();
        $save->title = $request->get('title');
        $save->type = $request->get('type');
        $save->slug = Str::slug($request->get('title'));
        $save->content = $request->get('content');
        if ($request->file('banner')) {
            $tujuan_upload = "photo_banner";
            $image = $request->file('banner');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $save->banner = $nama_file;
        }
        $save->save();
        if ($save) {
            //redirect dengan pesan sukses
            return redirect()->route('banner.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('banner.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $banner = Infobanner::findOrFail($id);
        return view('banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $messages = [
            'required' => 'Kolom Wajib diisi!',
            // 'banner.mimes'                         => 'Format gambar harus jpeg, png, jpg, gif, svg!',
            // 'banner.max'                           => 'Ukuran gambar harus di bawah 2MB!',
        ];

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            // 'banner'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ], $messages);
        $update = Infobanner::findOrFail($id);
        $update->type = $request->get('type');
        $update->title = $request->get('title');
        $update->content = $request->get('content');
        $update->slug = str::slug($request->get('title'));
        if ($request->file('banner')) {
            $tujuan_upload = "photo_banner";
            $image = $request->file('banner');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->banner = $nama_file;
        }
        $update->save();
        if ($update) {
            //redirect dengan pesan sukses
            return redirect()->route('banner.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('banner.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
            $delete = Infobanner::findOrFail($id)->delete();
            if ($delete) {
                return redirect()->route('banner.index')->with(['success' => 'Data Berhasil Dihapus!']);
            } else {
                return redirect()->route('banner.index')->with(['error' => 'Data Gagal Dihapus!']);
            }
    }
}
