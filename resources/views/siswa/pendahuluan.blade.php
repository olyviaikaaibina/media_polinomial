@extends('layout.halamanmateri')

@section('content')
   
@endsection

@section('nav')
    <a href="{{ route('petakonsep') }}" class="btn-nav">← Previous</a>
    <a href="{{ route('pengertianpolinomial') }}" class="btn-nav">Next →</a>
@endsection