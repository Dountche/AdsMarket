<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;


class FavoriteController extends Controller
{
    public function toggle(AD $ad){
        $user = Auth::user();
        $user->hasFavorited($ad)
        ? $user->favorites()->detach($ad)
        : $user->favorites()->attach($ad);
        return back();

    }
}
