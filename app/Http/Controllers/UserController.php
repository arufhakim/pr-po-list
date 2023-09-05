<?php

namespace App\Http\Controllers;

use App\User;
use App\ActivityLog;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('approved');
        $this->middleware('role:Admin')->except(['edit', 'update']);
        $this->middleware('role:Admin|Jasa Pabrik|Jasa Non Pabrik|Jasa Distribusi & Pemasaran|Jasa Investasi EPC')->only(['edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.user', [
            'users' => User::orderBy('status', 'desc')
                ->orderBy('created_at', 'desc')
                ->get(),
            'users_log' => ActivityLog::with('user')
                ->where('description', 'like', '%' . 'Pengguna Sistem' . '%')
                ->limit(20)
                ->orderBy('id', 'desc')
                ->get(),

        ]);
    }
    // Mengarahkan user ke halaman menunggu approval, ketika akun dinon-aktifkan oleh admin
    public function approval()
    {
        return view('auth.approval');
    }

    //Mengaktifkan user
    public function approved(User $user)
    {
        User::find($user['id'])->update([
            'status' => 1
        ]);

        activity()->log('Mengaktifkan Pengguna Sistem '. $user->name);

        toastr()->success('Pengguna ' . $user->name . ' Berhasil Diaktifkan!', 'Success');
        return redirect()->back();
    }

    //Menonaktifkan user
    public function unapproved(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $user->update([
            'status' => 0
        ]);

        activity()->log('Menonaktifkan Pengguna Sistem '. $user->name);

        toastr()->success('Pengguna ' . $user->name . ' Berhasil Di Nonaktifkan!', 'Success');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
        ], [
            'name.required' => 'Kolom nama lengkap tidak boleh kosong',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter',
            'username.required' => 'Kolom username tidak boleh kosong',
            'username.max' => 'Username tidak boleh lebih dari 50 karakter',
            'username.unique' => 'Username tidak tersedia',
            'role.required' => 'Kolom bagian tidak boleh kosong',
            'password.required' => 'Kolom password tidak boleh kosong',
            'password.min' => 'Minimal panjang password 8 karakter',
            'password.regex' => 'Format password tidak sesuai, harap periksa kembali',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRole($request['role']);

        activity()->log('Menambahkan Pengguna Sistem ' . $request['name']);

        toastr()->success('Pengguna ' . $request->name . ' Berhasil Ditambahkan!', 'Success');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'password_lama' => ['required', 'string', 'min:8', new MatchOldPassword],
            'password_baru' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
            'password_konfirmasi' => ['same:password_baru'],
        ], [
            'password_lama.required' => 'Kolom password lama tidak boleh kosong',
            'password_lama.min' => 'Minimal panjang password 8 karakter',
            'password_baru.required' => 'Kolom password baru tidak boleh kosong',
            'password_baru.min' => 'Minimal panjang password baru 8 karakter',
            'password_baru.regex' => 'Format password baru tidak sesuai, harap periksa kembali',
            'password_konfirmasi.same' => 'Password baru dan konfirmasi password baru harus sesuai'
        ]);

        $user->update([
            'password' => Hash::make($request['password_baru']),
        ]);

        toastr()->success('Password Berhasil Diubah!', 'Success');
        return redirect()->back();
    }

    //Mereset password user oleh admin, ketika user lupa password
    public function reset(Request $request)
    {
        $old_data = User::find($request->id);
        User::find($request->id)->update([
            'password' => Hash::make('User1234'),
        ]);

        activity()->log('Reset Password Pengguna Sistem ' . $old_data->name);

        toastr()->success('Password Pengguna ' . $old_data->name . ' Berhasil Direset!', 'Success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $old_data = User::find($request->id);
        User::find($request->id)->delete();

        activity()->log('Menghapus Pengguna Sistem ' . $old_data->name);

        toastr()->success('Pengguna ' . $old_data->name  . ' Berhasil Dihapus!', 'Success');
        return redirect()->back();
    }
}
