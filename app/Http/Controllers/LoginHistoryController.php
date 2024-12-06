<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function index()
    {
        $histories = LoginHistory::with('user')
            ->latest('login_at')
            ->paginate(10);

        return view('login-history.index', compact('histories'));
    }
} 