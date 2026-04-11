@extends('layout.halamanmateri')

@section('content')
@endsection

@section('nav')
    <a href="{{ route('teoremafaktor') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('kuisd') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection