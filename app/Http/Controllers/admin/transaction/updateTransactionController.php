<?php

namespace App\Http\Controllers\admin\transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateTransactionController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        // Validar o status recebido
        $validated = $request->validate([
            'status' => 'required|in:pendente,processando,concluido,rejeitado',
        ]);

        // Encontrar a transação
        $transaction = Transaction::findOrFail($id);

        // Verifique se a transação já está concluída
        if ($transaction->status == 'concluido') {
            return redirect()->back()->withErrors(['A transação já foi concluída e não pode ser alterada.']);
        }

        if ($transaction->status == 'rejeitado') {
            return redirect()->back()->withErrors(['A transação já foi rejeitada e não pode ser alterada.']);
        }

        // Se o status for "concluído"
        if ($validated['status'] == 'concluido') {
            try {
                DB::beginTransaction(); // Inicia uma transação no banco de dados

                // Verifica a ação da transação
                if ($transaction->action == 'depositar') {
                    // Lógica para adicionar o dinheiro ao saldo do usuário (apenas para depósito)
                    $user = User::findOrFail($transaction->userId);
                    $user->wallet->money +=  $transaction->money;
                    $user->wallet->save();

                    // Atualiza o status da transação
                    $transaction->status = 'concluido';
                    $transaction->save();

                    DB::commit(); // Confirma a transação no banco de dados

                    return redirect()->back()->with('success', 'Depósito concluído e dinheiro depositado com sucesso.');
                } elseif ($transaction->action == 'retirar') {
                    $transaction->status = 'concluido';
                    $transaction->save();
                    DB::commit(); // Confirma a transação sem alterar nada
                    return redirect()->back()->with('success', 'Transação de retirada concluída.');
                }
            } catch (\Exception $e) {
                DB::rollBack(); // Desfaz qualquer mudança no banco se ocorrer um erro
                return redirect()->back()->withErrors(['Erro ao concluir a transação']);
            }
        }

        // Se o status for "rejeitado"
        if ($validated['status'] == 'rejeitado') {
            try {
                DB::beginTransaction(); // Inicia uma transação no banco de dados

                // Verifica a ação da transação
                if ($transaction->action == 'depositar') {
                    // Atualiza o status da transação
                    $transaction->status = 'rejeitado';
                    $transaction->save();

                    DB::commit(); // Confirma a transação no banco de dados

                    return redirect()->back()->with('success', 'Depósito rejeitado com sucesso.');
                } elseif ($transaction->action == 'retirar') {

                    $user = User::findOrFail($transaction->userId);
                    $user->wallet->money += $transaction->money; // Adiciona o valor ao saldo do usuário
                    $user->wallet->save();

                    $transaction->status = 'rejeitado';
                    $transaction->save();
                    DB::commit(); // Confirma a transação sem alterar nada
                    return redirect()->back()->with('success', 'Transação de retirada rejeitada, saldo reajustado.');
                }
            } catch (\Exception $e) {
                DB::rollBack(); // Desfaz qualquer mudança no banco se ocorrer um erro
                return redirect()->back()->withErrors(['Erro ao concluir a transação']);
            }
        }

        // Caso o status não seja "concluido", apenas atualize o status
        $transaction->status = $validated['status'];
        $transaction->save();

        return redirect()->back()->with('success', 'Status da transação atualizado com sucesso.');
    }
}
