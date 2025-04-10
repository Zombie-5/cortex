<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class showUserController extends Controller
{
    public function show($id)
    {
        $user = User::with([
            'wallet',
            'bank',
            'products',
            'superior',
            'subordinates',
            'subordinatesVip',
            'manager',
            'gifts'
        ])->findOrFail(Crypt::decryptString($id));

       
        $totalDepositado = $user->totalDepositado();
        $totalRetirado = $user->totalRetirado();
        $presentesResgatados = $user->gifts()->where('status', 'used')->count();
        $totalResgatado = $user->gifts()->where('status', 'used')->sum('value');

        return view('admin.showUsers', compact('user', 'totalDepositado', 'totalRetirado', 'presentesResgatados', 'totalResgatado'));
    }
}
