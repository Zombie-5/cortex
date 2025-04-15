<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LinkController extends Controller
{
    public function index()
    {
        $links = Link::firstOrCreate(
            ['manager_id' => Auth::id()],
            [
                'link_manager' => null,
                'link_customer_service' => null,
                'link_group' => null,
            ]
        );

        return view('admin.link', compact('links'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'link_manager' => 'nullable|url',
            'link_customer_service' => 'nullable|url',
            'link_group' => 'nullable|url',
        ]);

        $links = Link::where('manager_id', Auth::id())->first();
        $links->link_manager = $request->link_manager;
        $links->link_customer_service = $request->link_customer_service;
        $links->link_group = $request->link_group;
        $links->save();

        return redirect()->back()->with('success', 'Links atualizados com sucesso!');
    }
}
