@extends('layouts.app')
@section('content')
@foreach ($viewimage as $image2)
   <img src="{{ url($image2) }}" class="thumb" alt="a picture" height="200"></br>
@endforeach
@endsection
