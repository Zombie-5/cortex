<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function bank()
    {
        $bankInfo = Bank::where('user_id', Auth::id())->first();
        return view('client.bank', compact('bankInfo'));
    }

    public function bank_choose()
    {
        $banks = Bank::where('is_admin', 1)->get();
        return view('client.bank-choose', compact('banks'));
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'iban' => 'required|string|max:255|unique:banks,iban,' . Auth::id() . ',user_id', // Evita duplicação do IBAN para outros usuários
        ]);

        // Obtém o banco do usuário, se existir
        $bank = Bank::where('user_id', Auth::id())->first();

        if ($bank) {
            // Atualiza os dados do banco existente
            $bank->update([
                'name' => $request->name,
                'owner' => $request->owner,
                'iban' => $request->iban,
            ]);

            return redirect()->back()->with('success', 'Informações bancárias atualizadas com sucesso.');
        } else {
            // Cria um novo banco para o usuário
            Bank::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'owner' => $request->owner,
                'iban' => $request->iban,
            ]);

            return redirect()->back()->with('success', 'Informações bancárias salvas com sucesso.');
        }
    }
}
