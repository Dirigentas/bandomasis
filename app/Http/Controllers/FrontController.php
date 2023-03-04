<?php

namespace App\Http\Controllers;

use App\Models\Front;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dish $dishes, Request $request)
    {
        if ($request->s)
        {
            $s = explode(' ', $request->s);
            
            //vieno zodzio paieska
            if(count($s) == 1) {
                $dishes = Dish::where('name', 'like', '%'.$s[0].'%');
            }
            //dvieju zodziu paieska
            else {
                $dishes = Dish::where('name', 'like', '%'.$s[0].'%'.$s[1].'%')->orWhere('name', 'like', '%'.$s[1].'%'.$s[0].'%');
            }
        } else {      
            if ($request->restaurant_id && $request->restaurant_id != 'all') {
                $dishes = Dish::where('id', $request->restaurant_id);
            }
            else {
                $dishes = Dish::where('id', '>', 0);
            }
        }

        $dishes = match($request->sort ?? '') {
            'asc_price' => $dishes->orderBy('price'),
            'desc_price' => $dishes->orderBy('price', 'desc'),
            default => $dishes
        };
        
         $dishes = $dishes->get(); //duomenu gavimas
         $rating = Front::all();
         $user = Auth::user();

         $restaurants = Restaurant::all()->sortBy('name');

        return view('front.home', [
            'dishes' => $dishes,
            'sortSelect' => Dish::SORT,
            'sortShow' => isset(Dish::SORT[$request->sort]) ? $request->sort : '',
            's' => $request->s ?? '',
            'user' => $user,
            'rating' => $rating,
            'restaurants' => $restaurants,
            'restaurantShow' => $request->restaurant_id ? $request->restaurant_id : '',
        ]);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Front $front): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Front $front): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Front $front): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Front $front): RedirectResponse
    {
        //
    }
}

?>