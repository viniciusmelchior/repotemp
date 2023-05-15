<?php

namespace App\Http\Controllers;

use App\Models\Functionality;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PerfilAcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //permitir via permissions. Procurar como faz com perfis de acesso
        // $this->authorize('visualizar perfis de acesso');
        // $users = User::permission('edit articles')->get();
        // dd($users);
        // $users = User::role('writer')->get();
        $user = User::find(Auth::user()->id);
        // $permissions = $user->permissions;
        // dd($permissions);
        // if($user->hasRole('writer')){
        //     dd("pode seguir");
        // }

        // $permissions = Permission::where('role_id', 4)->get();
        $permissions = Permission::all();
        $roles = Role::all();

        // dd($permissions, $roles);

        return view('perfisAcesso.index', compact(['permissions', 'roles']));

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissions = Permission::all();
        $role = Role::find($id);
        $functionalities = Functionality::all();
        $menus = Menu::all();

        return view('perfisAcesso.show', compact(['permissions', 'role','menus','functionalities']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $user = User::find(Auth::user()->id);
        $permissions = $request->input('permissions', []);

        //fixado para excluir as roles do editor
        $roles = Role::find($request->role_id);

        //Limpar todas as permissões do PERFIL (ROLE)
        $roles->permissions()->detach();

        foreach ($permissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->firstOrFail();
    
            // Atribuir a permissão ao perfil de usuário
            $roles->givePermissionTo($permission);
        }

        //Forçar a limpeza do Cache para as alterações surtirem efeito
        Artisan::call('cache:clear');
    
        return redirect()->back()->with('success', 'Permissões atualizadas com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
