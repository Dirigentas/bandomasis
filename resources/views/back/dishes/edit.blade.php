@extends('layouts.app')

@section('title', 'Redaguoti patiekalą')

@section('content')

<div class="container col-md-7 mt-3">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Patiekalo kortelės redagavimas</h5>
        </div>
        <form class="card-body" action='{{route('dishes-update', $dish)}}' method='post' enctype="multipart/form-data">
            <div class='row'>
                <div class='col'>
                    <label for="exampleInputEmail1" class="form-label">Restoranas</label>
                    <select class="form-select form-select-lg mb-4" aria-label="Default select example" name='restaurant'>
                        @foreach($restaurants as $value)
                        <option @if($dish->restaurant == $value->name) selected @endif value="{{$value->name}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class='col'>
                    <label for="exampleInputEmail1" class="form-label">Pavadinimas</label>
                    <input required class="form-control form-control-lg mb-4" type="text" name="name" value='{{$dish->name}}'>
                </div>
            </div>
            <div class='row'>
                <div class='col'>
                    <label for="exampleInputEmail1" class="form-label">Kaina</label>
                    <input required class="form-control form-control-lg mb-4" type="number" name="price" value='{{$dish->price}}'>
                </div>
            </div>
            <div class='row'>
                <div class='col-6'>
                    <label for="exampleInputEmail1" class="form-label">Nuotrauka</label>
                    <input class="form-control form-control-lg mb-4" type="file" name="photo">
                </div>
                @if($dish->photo)
                <div class='col'>
                    <img class='mb-3 rounded img-fluid' src="{{asset($dish->photo)}}">
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-outline-info">Atnaujinti</button>
            @if($dish->photo)
            <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">Ištrinti nuotrauką</button>
            @endif
            @csrf
            @method('put')
        </form>
    </div>
</div>

@endsection
