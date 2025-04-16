<?php

namespace App\Http\Controllers\admin\notice;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;

class StoreNoticesController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'notice' => 'required|string',
                'status' => 'nullable|boolean',
            ]);

            $notice = Notice::create([
                'notice' => $validated['notice'],
                'status' => $validated['status'] ?? false,
            ]);

            if ($notice) {
                return redirect()->back()->with('success', 'Notícia cadastrada com sucesso!');
            }

            return redirect()->back()->with('error', 'Erro ao cadastrar notícia. Tente novamente.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erro do servidor. Contate o desenvolvedor do sistema.');
        }
    }
}
