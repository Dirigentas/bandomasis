@extends('layouts.app')

@section('title', 'Pridėti naują patiekalą')

@section('content')

<div class="container col-md-7 mt-5">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Naujo patiekalo kortelė</h5>
        </div>
        <form class="card-body" action='{{route('dishes-store')}}' method='post' enctype="multipart/form-data">
            <label class="form-label">Restoranas</label>
            <select class="form-select form-select-lg mb-4" name='restaurant'>
                @foreach($restaurants as $value)
                <option value="{{$value->name}}">{{$value->name}}</option>
                @endforeach
            </select>
            <label class="form-label">Pavadinimas</label>
            <input required class="form-control form-control-lg mb-4" type="text" name="name">
            <div class='row'>
                <div class='col'>
                    <label class="form-label">Kaina</label>
                    <input required class="form-control form-control-lg mb-4" type="number" name="price" value="{{old('price')}}">
                </div>
            </div>
            <label class="form-label">Nuotrauka</label>
            <input class="form-control form-control-lg mb-4" type="file" name="photo">
            <button type="submit" class="btn btn-outline-info">Sukurti</button>
            @csrf
        </form>
    </div>
</div>

@endsection
