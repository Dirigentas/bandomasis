<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Response;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Dish $dishes)
    {
        $dishes = $dishes->get(); //duomenu gavimas
        
        return view('back.dishes.index', [
            'dishes' => $dishes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::all()->sortBy('name');
        
        return view('back.dishes.create', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dish = new Dish;

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // Intervention library nauojimas paveiksleliu apkirpimui
            // $manager = new ImageManager(['driver' => 'GD']);
            // $image = $manager->make($photo);
            // $image->crop(400, 200);
            // $image->save(public_path().'/hotels/'.$file);

            $photo->move(public_path().'/dishes', $file); // serveryje is TEMP dir perkeliama i normalia dir. Irasom i serveri su publick_path

            $dish->photo = '/dishes/'. $file; // issaugojimas i DB. O skaitom su Asset (kelias narsyklei)
        }

        $dish->restaurant = $request->restaurant;
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->save();

        return redirect()->back()->with('ok', 'Patiekalas pridėtas sėkmingai');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $restaurants = Restaurant::all()->sortBy('name');

        return view('back.hotels.edit', [
            'restaurants' => $restaurants,
            'dish' => $dish
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        // 'Istrinti nuotrauka' mygtuko paspaudimas
        if ($request->delete_photo) {
            $hotel->deletePhoto();
            return redirect()->back();
        }

        // vykdosi jei buvo uzkelta nauja nuotrauka
        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // Intervention library nauojimas paveiksleliu apkirpimui
            // $manager = new ImageManager(['driver' => 'GD']);
            // $image = $manager->make($photo);
            // $image->crop(400, 200);
            // $image->save(public_path().'/hotels/'.$file);      
            
            // kadangi buvo uzkelta nauja nuotrauka, senaja reikia istrinti
            if ($hotel->photo) {
                $hotel->deletePhoto();
            }
            
            $photo->move(public_path().'/dishes', $file); // serveryje is TEMP dir perkeliama i normalia dir. Irasom i serveri su publick_path
            $dish->photo = '/dishes/'. $file; // issaugojimas i DB. O skaitom su Asset (kelias narsyklei)
        }

        $dish->restaurant = $request->restaurant;
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->save();

        return redirect()->back()->with('ok', 'Patiekalas atnaujintas sėkmingai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->deletePhoto();
        $dish->delete();
        
        return redirect()->back()->with('ok', 'Patiekalas ištrintas sėkmingai');
    }
}
