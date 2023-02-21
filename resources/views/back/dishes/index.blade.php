@extends('layouts.app')

@section('title', 'Patiekalų sąrašas')

@section('content')

<div class='container'>
    <div class="card">
        <h3 class="fw-bold card-header text-center">
            Patiekalų sąrašas
        </h3>
        <ul class="list-group">
            @foreach($dishes as $value)
            <li class="list-group-item d-flex">
                <div class='fw-bold col'> {{$value->name}}</div>
                <div class='col'> {{$value->restaurant}}</div>
                <div class='col'> {{$value->price}} Eur</div>
                @if($value->photo)
                <div class='col-1'> <img class='col-6 img-fluid img-thumbnail' src='{{asset($value->photo)}}'></div>
                @else
                <div class='col-1'> <img class='col-6 img-fluid img-thumbnail' src='{{asset('no.jpg')}}'></div>
                @endif
                <div class='col'>
                    <a href='{{route('dishes-edit', $value)}}' class="btn btn-outline-primary">Redaguoti</a>
                </div>
                <form action='{{route('dishes-destroy', $value)}}' method='post' class='col'>
                    <button type="submit" class="btn btn-outline-danger">Ištrinti</button>
                    @method('delete')
                    @csrf
                </form>

            </li>
            @endforeach
        </ul>
    </div>
</div>


@endsection
