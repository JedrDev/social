<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($query)
    {
        return User::select('id','name','nickname','profile_photo_path')
            ->where('name', 'like', '%'.$query.'%')
            ->orWhere('nickname', 'like', '%'.$query.'%')
            ->get();
    }
}
