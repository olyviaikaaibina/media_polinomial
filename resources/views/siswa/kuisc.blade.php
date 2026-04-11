@extends('layout.halamanmateri')

@section('content')
@endsection

@section('nav')
    <a href="{{ route('teoremasisa') }}" class="btn-nav prev-btn">
        ← Previous
    </a>

    <a href="{{ route('teoremafaktor') }}" class="btn-nav next-btn">
        Next →
    </a>
@endsection