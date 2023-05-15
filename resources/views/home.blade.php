@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                <div class="card-body">
                    @role('editor')
                    Sou Editor!
                    @endrole
                </div>
                <div class="card-body">
                    @role('writer')
                    Sou Escritor!
                    @endrole
                </div>
                <div class="card-body">
                    @role('user')
                    Sou um usuário comum!
                    @endrole
                </div>
                <div class="card-body">
                    @role('admin')
                    Sou Administrador!
                    @endrole
                </div>

                <hr>
                <h3>O que posso fazer?</h3>
                <div class="card-body">
                    @can('edit articles')
                        Editar Artigos
                    @endcan
                </div>
                <div class="card-body">
                    @can('create articles')
                        Criar Artigos
                    @endcan
                </div>
                <div class="card-body">
                    @can('delete articles')
                        Deletar Artigos
                    @endcan
                </div>
                <div class="card-body">
                    @can('editar perfil')
                        Editar Perfis de Acesso
                    @endcan
                </div>
                <div class="card-body">
                    @can('deletar perfil')
                        Deletar Perfis de Acesso
                    @endcan
                </div>
                <div class="card-body">
                    @can('criar perfil')
                        Criar Perfis de Acesso
                    @endcan
                </div>
                <div class="card-body">
                    @can('visualizar perfil')
                        Visualizar Perfis de Acesso
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
