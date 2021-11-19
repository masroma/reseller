<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    use ValidatesRequests;
    public function data(){
        try{
            $data = User::all();
            return datatables()->of($data)
            ->addIndexColumn()
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
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('user.create');
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
            'unique' => 'Kode sudah digunakan',
            'email' => 'Kolom harus format email'
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ], $messages);

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $messages = [
            'required' => 'Kolom Wajib diisi!',
            'unique' => 'Email sudah digunakan',
            'email' => 'Kolom harus format email'
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,

        ], $messages);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if(Auth::user()->id != $id){
            $user = User::findOrFail($id)->delete();
            if ($user) {
                return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
            } else {
                return redirect()->route('user.index')->with(['error' => 'Data Gagal Dihapus!']);
            }
        }else{
                return redirect()->route('user.index')->with(['error' => 'Data Gagal Dihapus!']);
        }


    }

    public function editprofile(){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.editprofile',compact('user'));
    }

    public function proseseditprofile(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $messages = [
            'required' => 'Kolom Wajib diisi!',
            'unique' => 'Kode sudah digunakan',
            'email' => 'Kolom harus format email'
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:tbl_proyek_perumahan,kode_proyek,'.$user->id,

        ], $messages);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->save();

        if($request->password != null){
            $user->password = bcrypt($request->password);
            $user->save();
        }


        if ($user) {
            //redirect dengan pesan sukses
            return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('user.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
