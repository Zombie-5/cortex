<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        $user = User::findOrFail(Auth::id());
        return view('client.withdraw', compact('user'));
    }

    public function store(Request $request)
    {
        // Validação de entrada
        $request->validate([
            'amount' => 'required|numeric|min:8 |max:400',
        ], [
            'amount.required' => 'O montante é obrigatório.',
            'amount.numeric' => 'O montante deve ser númerico.',
            'amount.min' => 'O saque mínimo permitido é de 8 USDT',
            'custom-amount.max' => 'O saque máximo permitido é de 400 USDT',
        ]);

        $withdrawAmount = $request->input('amount');

        // Recuperando o usuário logado
        $user = User::findOrFail(Auth::id());
        if (!$user->bank) {
            return redirect()->back()->with('error', 'Você precisa actualizar suas informações bancária');
        }    

        if (!$user->is_vip) {
            return back()->withErrors(['Apenas investidores podem soicitar saques, invista em um produto e se torne um investidores']);
        }

        // Obtém o horário atual
        $currentTime = Carbon::now();

        // Define o intervalo de horário permitido
        $startTime = Carbon::createFromTime(10, 0, 0);  // 09:00
        $endTime = Carbon::createFromTime(15, 0, 0);   // 14:00

        // Verifica se o dia é sábado ou domingo
        if ($currentTime->isWeekend()) {
            return back()->withErrors(['A solicitação de saque não pode ser feita durante o fim de semana. O horário é de segunda a sexta-feira.']);
        }

        // Verifica se o horário atual está fora do intervalo permitido (9h às 14h)
        if ($currentTime->lt($startTime) || $currentTime->gt($endTime)) {
            return back()->withErrors(['O horário para solicitação de saque é das 10h às 15h, de segunda a sexta-feira.']);
        }

        // Lógica de depósito
        Transaction::create([
            'type' => 'retirar',
            'value' => ($withdrawAmount - ($withdrawAmount*0.15)),
            'user_id' => $user->id,
        ]);

        $user->wallet->money -= $withdrawAmount;
        $user->wallet->points -= 500;
        $user->wallet->save();

        return redirect()->route('client.record.withdraw')->with('success', 'Retirada solicitada com sucesso!');
    }
}
