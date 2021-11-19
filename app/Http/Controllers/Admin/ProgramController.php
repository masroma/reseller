<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;
    public function data(){
        try{
            $data = Program::all();
            return datatables()->of($data)
            ->addColumn('logo', function ($data) {
                $url= asset('photo_program/'.$data->logo);
                return '<img src="'.$url.'" border="0" width="150" class="img-rounded" align="center" />';
            })
            ->addColumn('image', function ($data) {
                $url= asset('photo_program/'.$data->image);
                return '<img src="'.$url.'" border="0" width="150" class="img-rounded" align="center" />';
            })
            ->addIndexColumn()
            ->rawColumns(['logo','image'])
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
        return view('program.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('program.create');
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
            'image.mimes'                         => 'Format gambar harus jpeg, png, jpg, gif, svg!',
            'image.max'                           => 'Ukuran gambar harus di bawah 2MB!',
        ];

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'logo'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ], $messages);

        $save = new Program();
        $save->title = $request->get('title');
        $save->content = $request->get('content');
        if ($request->file('logo')) {
            $tujuan_upload = "photo_program";
            $image = $request->file('logo');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $save->logo = $nama_file;
        }
        if ($request->file('image')) {
            $tujuan_upload = "photo_program";
            $image = $request->file('image');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $save->image = $nama_file;
        }
        $save->save();
        if ($save) {
            //redirect dengan pesan sukses
            return redirect()->route('program.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('program.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $data = Program::findOrFail($id);
        return view('program.edit',compact('data'));
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
            'image.mimes'                         => 'Format gambar harus jpeg, png, jpg, gif, svg!',
            'image.max'                           => 'Ukuran gambar harus di bawah 2MB!',
        ];

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'logo'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'image'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ], $messages);
        $update = Program::findOrFail($id);
        $update->title = $request->get('title');
        $update->content = $request->get('content');
        if ($request->file('logo')) {
            $tujuan_upload = "photo_program";
            $image = $request->file('logo');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->logo = $nama_file;
        }
        if ($request->file('image')) {
            $tujuan_upload = "photo_program";
            $image = $request->file('image');
            $namareplace_ = str_replace(' ', '_', $image->getClientOriginalName());
            $nama_file = time() . "_" . $namareplace_;
            $image->move($tujuan_upload, $nama_file);
            $update->image = $nama_file;
        }
        $update->save();
        if ($update) {
            //redirect dengan pesan sukses
            return redirect()->route('program.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('program.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
            $delete = Program::findOrFail($id)->delete();
            if ($delete) {
                return redirect()->route('program.index')->with(['success' => 'Data Berhasil Dihapus!']);
            } else {
                return redirect()->route('program.index')->with(['error' => 'Data Gagal Dihapus!']);
            }
    }
}
