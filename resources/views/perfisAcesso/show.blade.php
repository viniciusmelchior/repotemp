@php
    use App\Models\User;
    use App\Models\Functionality;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    $user = User::find(Auth::user()->id);
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <h1>Nome do Perfil: {{$role->name}}</h1>
    </div>

    <div class="row justify-content-center">
        <form method="POST" action="{{ route('perfilAcesso.update') }}">
            @csrf
            {{-- @foreach ($permissions->groupBy('functionality.name') as $functionality => $functionalityPermissions)
                <div>
                    <h3>{{ $functionality }}</h3>
                </div>
                <div>
                    @foreach ($functionalityPermissions as $permission)
                        <div>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                            <label>{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach --}}
            @php $rowspan = 0; @endphp
            @foreach ( $menus as $menu )
                @php 
                    $functionalities = Functionality::where('menu_id', $menu->id)->get();
                    $permisions = Permission::where('menu_id', $menu->id)->get();
                @endphp
                <div class="card mt-3 p-3">
                <div class="d-flex">
                    <div class="w-25"></div>
                    <div class="w-25"><h3>{{ $menu->name }}</h3></div>
                </div>
                @foreach ($functionalities as $functionality )
                <table class="table table mb-4">
                        @php
                            $permissions_rowspan = Permission::where('menu_id', $menu->id)->where('functionality_id',$functionality->id)->get();
                            $rowspan = count($permissions_rowspan);
                        @endphp
                        @if($menu->id == $functionality->menu_id)
                            <tr style="border: none;">
                                <td rowspan="{{$rowspan}}" class="w-25 align-middle text-center" style="border: none;">{{$functionality->name}}</td>
                                @foreach ( $permissions_rowspan as $permission )
                                @if($functionality->id == $permission->functionality_id)
                                    <td class="p-2" style="border: none;">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                                            <label>{{ $permission->name }} {{-- {{$rowspan}} --}}</label>
                                    </td>  
                            </tr>
                                @endif
                                @endforeach
                        @endif
                    @endforeach
                </table>
                </div>

            @endforeach
            <input type="hidden" name="role_id" value="{{$role->id}}">
            <button type="submit">Atualizar Permissões</button>
        </form>
        <a href="{{route('perfilAcesso.index')}}">Voltar</a>
    </div>
</div>
@endsection