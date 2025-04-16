<?php

namespace App\Http\Controllers\admin\notice;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class IndexNoticesController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('id', 'desc')->get();
        return view('admin.notice', compact('notices'));
    }
}
