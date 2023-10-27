<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $Users = User::all();

        return view('user.index', compact('Users'));
    }

    public function create()
    {
        //menampilkan layouting pada folder resources-views
        return view('user.create');
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',       
            'role'=>'required',
    
        ]);


        $password = substr($request->email, 0, 3) . substr($request->name, 0, 3);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,       
            'role'=>$request->role,
            'password' =>Hash::make($password)
            
        ]);

        return redirect()->back()->with('success','Berhasil menambah data!!');
    }
    public function edit($id)
    {
        $Users = User::find($id);
        return view('user.edit', compact('Users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.home')->with('error', 'Akun tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,cashier',
        ]);

        if ($request->password) {
            // $password = substr($request->email, 0, 3).substr($request->name, 0, 3);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
        }

        return redirect()->route('user.home')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}