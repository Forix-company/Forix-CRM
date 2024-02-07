<?php

namespace Modules\Base\Http\Controllers;

use Modules\Base\Http\Requests\StoreUsuarioRequest;
use Modules\Base\Http\Requests\UpdateUsuarioRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Allusuarios = DB::table("users")->count();

        $administrador = DB::table("users")->where("users.user_id", 1)->count();

        $supervisor = DB::table("users")->where("users.user_id", 2)->count();

        $usuarios = DB::table("users")->join("roles", "roles.id", "=", "users.user_id")
            ->select("users.id", "users.name", "users.email", "users.user_id", "users.photo", "users.blocked_temporarily", "users.blocked_permanently", "roles.name_roles")->get();

        return view('base::Dashboard.Usuario.index', compact('usuarios', 'Allusuarios', 'administrador', 'supervisor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuarioRequest $request)
    {
        $usuario = new User();
        $usuario->name = $request->NombreCompleto;
        $usuario->email = $request->email;
        $usuario->user_id = $request->user_id;
        $usuario->password = Hash::make($request->password);
        $usuario->login_2fa_statu = 1;

        if ($request->file('foto')) {
            $image = $request->file('foto');
            $photo_avatar = 'avatars/' . $image->getClientOriginalName();
            Storage::disk('avatars')->putFileAs('', $request->file('foto'), $image->getClientOriginalName());
            $usuario->photo = $photo_avatar;
        } else {
            $usuario->photo = 'img/avatar_default.png';
        }

        $usuario->save();
        return redirect('usuario')->with('success', 'Se creo el usuario exitosamente !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $User = User::find($id);
        return view('base::Dashboard.Usuario.show', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $User = User::find($id);
        return view('base::Dashboard.Usuario.edit', compact('User'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsuarioRequest $request, $id)
    {

        $image = $request->file('foto');
        if ($request->file('foto')) {

            $photo_avatar = 'avatars/' . $image->getClientOriginalName();
            Storage::disk('avatars')->putFileAs('', $image, $image->getClientOriginalName());
        }

        if ($request->login_2fa_statu == 1) {
            User::where('id', $id)->update([
                'name' => $request->NombreCompleto,
                'email' => $request->email,
                'user_id' => $request->user_id,
                'password' => Hash::make($request->password),
                'login_2fa_statu' => $request->login_2fa_statu,
                'photo' => $image ? $photo_avatar : 'avatars/avatar_default.png',
                'token_login' => null
            ]);
            return redirect('usuario')->with('success', 'Se actualizo los datos exitosamente !');
        } else {
            User::where('id', $id)->update([
                'login_2fa_statu' => $request->login_2fa_statu
            ]);
            Auth::logout();
            return redirect('login')->with('success', 'Se cambio el metodo de inicio por favor vuelva a iniciar en el sistema !!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('usuario')->with('error', 'Se elimino el usuario exitosamente !');
    }
}
