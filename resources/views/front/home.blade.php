@extends('layouts.front')

@section('title', 'Įvertink restoraną')

@section('content')

<div class='container text-center'>
    <div class="card">
        <div class='card-header'>
            <h3 class='mb-3'>Restoranų reitingas</h3>
            <form class='row mb-3' action="{{route('index')}}" method='get'>
                <div class="col-3">
                    <select class="form-select" name="restaurant_id">
                        <option value="all">Restoranų sąrašas</option>
                        @foreach($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}" @if($restaurant->id == $restaurantShow) selected @endif>{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class='col-4'>
                    <select class="form-select" name='sort'>
                        <option value='all' selected>Rūšiuoti</option>
                        @foreach($sortSelect as $index => $value)
                        <option value="{{$index}}" @if($sortShow==$index) selected @endif>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="ms-3 col-1 btn btn-outline-primary">Rodyti</button>
                <a href='{{route('index')}}' class='ms-3 col-1 btn btn-outline-warning'>Išvalyti</a>
                @csrf
            </form>
            <form class='row' action="{{route('index')}}" method='get'>
                <div class='col-4'>
                    <input name='s' type="text" class="form-control" placeholder="Ieškoti pagal patiekalo pavadinimą" value="{{$s}}">
                </div>
                <button type="submit" class="ms-3 col-1 btn btn-outline-primary">Ieškoti</button>
                @csrf
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach($dishes as $dish)
        <div class="col-6 mt-5">
            @if($dish->photo)
            <img class='img-fluid img-thumbnail' src='{{asset($dish->photo)}}'>
            @else
            <img class='img-fluid img-thumbnail' src='{{asset('http://localhost/bandomasis/public/no.jpg')}}'>

            @endif
            <div> {{$dish->restaurant}}</div>
            <div class='fw-bold col'> {{$dish->name}}</div>
            <div> {{round($dish->price, 0)}} Eur</div>
            <div>
                Įvertinimas: {{$dish->rating}}
            </div>
            @if(isset($user))
            <form class='mt-3' action="{{route('update_rating', $dish)}}" method="post" enctype="multipart/form-data">
                <label>Tavo įvertinimas: </label>
                <input required type="number" min="1" max='5' name="rating">
                <button type="submit" class="col-12 mt-3 btn btn-outline-primary">Įvertinti</button>
                @csrf
                @method('put')
            </form>
            @else
            <a href='{{route('home')}}' class="col-12 mt-3 btn btn-outline-primary">Rezervuoti (reikalingas prisijungimas)</a>
            @endif

        </div>
        @endforeach
    </div>

</div>

@endsection
