<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{ 
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        // Favorite::create([
        //     'user_id'       => auth()->id(),
        //     'favorited_id'  => $reply->id,
        //     'favorited_type' => get_class($reply),
        // ]);

        // $reply->favorites()->create(['user_id' => auth()->id(),]);

        $reply->favorite();

        return back();
    }
}
