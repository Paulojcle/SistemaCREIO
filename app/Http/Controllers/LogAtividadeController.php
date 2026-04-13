<?php

namespace App\Http\Controllers;

use App\Models\LogAtividade;
use App\Models\User;
use Illuminate\Http\Request;

class LogAtividadeController extends Controller
{
    public function index(Request $request){
        $usuarios = User::orderBy('firstName')->get();

        $modulos = LogAtividade::select('modulo')->distinct()->orderBy('modulo')->pluck('modulo');

        $query = LogAtividade::with('user')->orderByDesc('created_at');

        if ($request->filled('user_id')){
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('modulo')){
            $query->where('modulo', $request->modulo);
        }

        if ($request->filled('data_inicio')){
            $query->whereDate('created_at','>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')){
            $query->whereDate('created_at', '<=', $request->data_fim);
        }

        $logs = $query->paginate(50)->withQueryString();

        return view ('logs.index', compact('logs', 'usuarios', 'modulos'));
    }
}
