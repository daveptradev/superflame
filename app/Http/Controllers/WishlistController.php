<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle($id)
{
    // USER LOGIN
    if(auth()->check()){

        $user = auth()->user();

        $wishlist = Wishlist::where(
            'user_id',
            $user->id
        )
        ->where(
            'product_id',
            $id
        )
        ->first();

        if($wishlist){

            $wishlist->delete();

            return redirect('/profile?tab=wishlist')
                ->with(
                    'success',
                    'Removed from wishlist'
                );

        }else{

            Wishlist::create([

                'user_id' => $user->id,

                'product_id' => $id
            ]);

            return back()->with(
                'success',
                'Added to wishlist'
            );
        }
    }

    // GUEST
    else{

        $wishlist = session()->get(
            'wishlist',
            []
        );

        if(
            in_array(
                $id,
                $wishlist
            )
        ){

            $wishlist = array_diff(
                $wishlist,
                [$id]
            );

            $msg =
            'Removed from wishlist';

        }else{

            $wishlist[] = $id;

            $msg =
            'Added to wishlist';
        }

        session([
            'wishlist' => $wishlist
        ]);

        return back()->with(
            'success',
            $msg
        );
    }
}
}