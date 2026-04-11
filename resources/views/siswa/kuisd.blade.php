@extends('layout.halamanmateri')

@section('content')
@endsection

@section('nav')
    <a href="{{ route('faktordanpembuatnol') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('identitaspolinomial') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection