<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Found;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {

        /* User data */
        $totalUsers = User::where('manager_id', Auth::id())->count();
        $totalVipUsers = User::where('manager_id', Auth::id())->where('is_vip', true)->count();

        /* $topUsers = User::where('manager_id', Auth::id()) // Filtra pelo usuário logado
            ->whereNotIn('tel', ['admin@cortex.com', '921621790', 'lilcrypto@cortex.com', 'tel' => 'youngvisa@cortex.com']) // Exclui os admins
            ->orderBy('id', 'asc')
            ->get();
 */
        /* User::with('subordinates1') // Apenas subordinates1 pode ser carregado diretamente
            ->get() // Pega os dados do banco primeiro
            ->map(function ($user) {
                $subordinates2 = $user->subordinates1->flatMap->subordinates; // Obtém os subordinados de nível 2

                $totalVipSubordinates = $user->subordinates1->where('is_vip', true)->count() +
                    $subordinates2->where('is_vip', true)->count();

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'tel' => $user->tel,
                    'vip_subordinates_count' => $totalVipSubordinates
                ];
            })
            ->sortByDesc('vip_subordinates_count')
            ->take(5); */


        /* Product data */
        //$totalProductsSold = DB::table('product_users')->count();
        $totalProducts = Product::count();
        $totalProductsSold = DB::table('product_users')
            ->join('users', 'product_users.user_id', '=', 'users.id')
            ->where('users.manager_id', Auth::id())
            ->count();

        /* Money Data */
        //$totalDeposited = Transaction::where('type', 'depositar')->where('status', 'concluido')->sum('value');
        //$totalWithdrawn = Transaction::where('type', 'retirar')->where('status', 'concluido')->sum('value');
        $found = Found::first();

        $totalDeposited = Transaction::where('type', 'depositar')
            ->where('status', 'concluido')
            ->whereHas('user', function ($query) {
                $query->where('manager_id', Auth::id());
            })
            ->sum('value');

        $totalWithdrawn = Transaction::where('type', 'retirar')
            ->where('status', 'concluido')
            ->whereHas('user', function ($query) {
                $query->where('manager_id', Auth::id());
            })
            ->sum('value');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalVipUsers',
            'totalProducts',
            'totalProductsSold',
            'totalDeposited',
            'totalWithdrawn',
            'found'
        ));
    }
}
