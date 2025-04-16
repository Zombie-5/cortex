<?php

namespace App\Http\Controllers\admin\notice;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UpdateNoticesController extends Controller
{
    public function update($id)
    {
        try {
            $notice = Notice::findOrFail(Crypt::decryptString($id));
            $notice->status = !$notice->status;
            $notice->save();

            if ($notice->status) {
                return redirect()->back()->with('success', 'Noticia divulgada com sucesso!');
            }
            return redirect()->back()->with('success', 'Noticia oculta !');
        } catch (Exception $e) {         
            return redirect()->back()->with('error', "Ocorreu um erro ao divulgar Noticia!" . $e->getMessage());
        }
    }
}
