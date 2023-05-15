@php
    use App\Models\User;
    use Spatie\Permission\Models\Permission;
    use Spatie\Permission\Models\Role;

    $user = User::find(Auth::user()->id);
@endphp

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
       <h1>Perfis de Acesso</h1>
    </div>

    <div class="row justify-content-center">
        @foreach ($roles as $role)
            <a href="{{route('perfilAcesso.show',[$role->id])}}">{{$role->name}}</a>
        @endforeach
    </div>
    
</div>
@endsection