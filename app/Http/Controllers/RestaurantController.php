<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        $restaurants = $restaurant->get(); //duomenu gavimas
        
        return view('back.restaurants.index', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'name' => 'required|alpha|min:4|max:100',
            'city' => 'required|alpha|min:3|max:50',
            'start' => 'required|date_format:"H:i',
            'end' => 'required|date_format:"H:i',
            ],
        [
            'name' => 'Netinkamas vardo formatas',
            'surncityame' => 'Netinkamas miesto formatas',
            'start' => 'netinkamas laiko formatas',
            'end' => 'netinkamas laiko formatas, turi būti vėlesnis nei pradžios laikas',
        ]);

            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $restaurant = new Restaurant;
        $restaurant->name = $request->name;
        $restaurant->city = $request->city;
        $restaurant->address = $request->address;
        $restaurant->start = $request->start;
        $restaurant->end = $request->end;
        $restaurant->save();

        return redirect()->back()->with('ok', 'Restoranas pridėta sėkmingai');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('back.restaurants.edit', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->name = $request->name;
        $restaurant->city = $request->city;
        $restaurant->address = $request->address;
        $restaurant->start = $request->start;
        $restaurant->end = $request->end;
        $restaurant->save();

        return redirect()->back()->with('ok', 'Restoranas atnaujintas sėkmingai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if (!$restaurant->restaurantDishes()->count()) {
            $restaurant->delete();
            return redirect()->back()->with('ok', 'Restoranas ištrintas sėkmingai');
        }

        return redirect()->back()->with('not', 'Restoranas turi susietų patiekalų');
    }
}
?>