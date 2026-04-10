<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permissao;

class PermissoesSeeder extends Seeder
{
    public function run(): void
    {
        $permissoes = [
            ['nome' => 'usuarios.gerenciar',       'descricao' => 'Criar, editar e desativar usuários e perfis'],
            ['nome' => 'alunos.gerenciar',          'descricao' => 'Cadastrar e editar alunos'],
            ['nome' => 'profissionais.gerenciar',   'descricao' => 'Cadastrar e editar profissionais'],
            ['nome' => 'agendamentos.visualizar',   'descricao' => 'Visualizar agendamentos'],
            ['nome' => 'agendamentos.gerenciar',    'descricao' => 'Criar e editar agendamentos'],
            ['nome' => 'atendimentos.gerenciar',    'descricao' => 'Lançar e editar atendimentos'],
            ['nome' => 'listas_espera.gerenciar',   'descricao' => 'Gerenciar filas de espera'],
            ['nome' => 'escolas.gerenciar',         'descricao' => 'Cadastrar e editar escolas'],
            ['nome' => 'configuracoes.gerenciar',   'descricao' => 'Gerenciar diagnósticos, deficiências e origens'],
            ['nome' => 'relatorios.visualizar', 'descricao' => 'visuzalizar relatórios de atendimento'],
        ];

        foreach ($permissoes as $permissao) {
            Permissao::firstOrCreate(['nome' => $permissao['nome']], $permissao);
        }
    }
}
