<?php

namespace Database\Seeders;

use App\Models\Functionality;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Configurações básicas que deverão ser colocadas no ar como primeira atividade ao colocar o sistema no ar (não enviar para o GIT)
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'aluno']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'professor']);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password  
        ])->assignRole('admin');  

        $editor = User::create([
            'name' => 'aluno',
            'email' => 'aluno@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password 
        ])->assignRole('aluno');  

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password 
        ])->assignRole('user'); 

        $writer = User::create([
            'name' => 'professor',
            'email' => 'professor@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password 
        ])->assignRole('professor');  

        //criar os menus 
        $menu_cadastro = Menu::create(['name' => 'Cadastro']);
        $menu_institucional = Menu::create(['name' => 'Institucional']);
        $menu_relatórios = Menu::create(['name' => 'Relatórios']);
        $menu_configuracoes = Menu::create(['name' => 'Configurações']);

        //Criar Funcionalidades 
        $funcionalidade_perfis_acesso = Functionality::create(['name' => 'Perfis de Acesso', 'menu_id' => 1]);
        $funcionalidade_usuarios = Functionality::create(['name' => 'Usuários', 'menu_id' => 1]);
        $funcionalidade_diario_eletronico = Functionality::create(['name' => 'Diário Eletrônico', 'menu_id' => 2]);

        //TESTES com adição da coluna correspondente à funcionalidade
        // $edit_articles = Permission::create(['name' => 'edit articles', 'functionality_id' => 1]);
        // $create_articles = Permission::create(['name' => 'create articles', 'functionality_id' => 1]);
        // $delete_permissions = Permission::create(['name' => 'delete articles', 'functionality_id' => 1]);

        $visualizar_tela_usuarios = Permission::create(['name' => 'visualizar tela usuarios', 'functionality_id' => 2, 'menu_id' => 1]);
        $cadastrar_novo_usuario = Permission::create(['name' => 'cadastrar novo usuario', 'functionality_id' => 2, 'menu_id' => 1]);
        $visualizar_usuario = Permission::create(['name' => 'visualizar usuario', 'functionality_id' => 2, 'menu_id' => 1]);
        $editar_usuario = Permission::create(['name' => 'editar usuario', 'functionality_id' => 2, 'menu_id' => 1]);
        $excluir_usuario = Permission::create(['name' => 'excluir usuario', 'functionality_id' => 2, 'menu_id' => 1]);

        $visualizar_tela_perfil_acesso = Permission::create(['name' => 'visualizar tela perfil acesso', 'functionality_id' => 1, 'menu_id' => 1]);
        $cadastrar_novo_perfil_acesso = Permission::create(['name' => 'cadastrar novo perfil', 'functionality_id' => 1, 'menu_id' => 1]);
        $visualizar_perfil_acesso = Permission::create(['name' => 'visualizar perfil', 'functionality_id' => 1, 'menu_id' => 1]);
        $editar_perfil_acesso = Permission::create(['name' => 'editar perfil', 'functionality_id' => 1, 'menu_id' => 1]);
        $excluir_perfil_acesso = Permission::create(['name' => 'excluir perfil', 'functionality_id' => 1,  'menu_id' => 1]);

        $larcar_faltas = Permission::create(['name' => 'lançar faltas', 'functionality_id' => 3,  'menu_id' => 2]);
        $visualizar_notas = Permission::create(['name' => 'visualizar notas', 'functionality_id' => 3,  'menu_id' => 2]);



        //todas as permissões conectadas ao admin. Por Padrão ao inicializar o sistema a permissão de admin é 1. 
        $role = Role::find(1);
        $role->givePermissionTo($visualizar_tela_perfil_acesso);
        $role->givePermissionTo($cadastrar_novo_perfil_acesso);
        $role->givePermissionTo($visualizar_perfil_acesso);
        $role->givePermissionTo($editar_perfil_acesso);
        $role->givePermissionTo($excluir_perfil_acesso);

        $role->givePermissionTo($visualizar_tela_usuarios);
        $role->givePermissionTo($cadastrar_novo_usuario);
        $role->givePermissionTo($visualizar_usuario);
        $role->givePermissionTo($editar_usuario);
        $role->givePermissionTo($excluir_usuario);

        $role->givePermissionTo($larcar_faltas);
        $role->givePermissionTo($visualizar_notas);

    }
}
