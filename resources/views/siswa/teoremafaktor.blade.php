@extends('layout.halamanmateri')

@section('content')
@endsection

@section('nav')
    <a href="{{ route('kuisc') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('faktordanpembuatnol') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection