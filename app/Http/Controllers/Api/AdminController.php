<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MonthlyDue;
use App\Models\StickerApplication;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $sticker_applications = StickerApplication::where('status', 'pending')->count();
        $pending_payments = MonthlyDue::where('status', 'pending_verification')->count();
        return response()->json(compact('sticker_applications', 'pending_payments'));
    }
}
