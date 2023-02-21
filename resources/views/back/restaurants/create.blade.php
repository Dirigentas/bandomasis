@extends('layouts.app')

@section('title', 'Pridėti naują restoraną')

@section('content')

<div class="container col-md-7 mt-5">
    <div class="card">
        <div class='card-header'>
            <h5 class="card-title text-center">Naujo restorano kortelė</h5>
        </div>
        <form class="card-body" action='{{route('restaurants-store')}}' method='post' enctype="multipart/form-data">
            <label for="exampleInputEmail1" class="form-label">Pavadinimas</label>
            <input required class="form-control form-control-lg mb-4" type="text" name="name">
            <label for="exampleInputEmail1" class="form-label">Miestas</label>
            <input required class="form-control form-control-lg mb-4" type="text" name="city">
            <label for="exampleInputEmail1" class="form-label">Adresas</label>
            <input required class="form-control form-control-lg mb-4" type="text" name="address">
            <label for="exampleInputEmail1" class="form-label">Darbo laiko pradžia</label>
            <input required class="form-control form-control-lg mb-4" type="time" name="start">
            <label for="exampleInputEmail1" class="form-label">Darbo laiko pabaiga</label>
            <input required class="form-control form-control-lg mb-4" type="time" name="end">
            <button type="submit" class="btn btn-outline-info">Sukurti</button>
            @csrf
        </form>
    </div>
</div>

@endsection
