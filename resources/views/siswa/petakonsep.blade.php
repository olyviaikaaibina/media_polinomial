@extends('layout.halamanmateri')

@section('content')
    <style>
        .peta-page {
            width: 100%;
            padding: 4px 20px 0;
            box-sizing: border-box;
        }

        .peta-card {
            width: 100%;
            max-width: 1150px;
            margin: 0 auto;
            padding: 10px 20px 10px;
            box-sizing: border-box;
            text-align: center;
        }

        .peta-title {
            font-family: 'Playfair Display', serif;
            color: #2f5d3a;
            font-weight: 800;
            font-size: 30px;
            margin: 0 0 10px;
            text-align: center;
        }

        .peta-image-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .peta-image {
            width: 88%;
            max-width: 920px;
            height: 360px;
            object-fit: fill;
            display: block;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
        }

        .peta-button-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 0;
        }

        .btn-peta {
            display: inline-block;
            background: #8F9F76;
            color: white;
            border-radius: 999px;
            padding: 8px 26px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            border: none;
            transition: 0.2s ease;
            min-width: 150px;
            text-align: center;
        }

        .btn-peta:hover {
            background: #7f8f67;
            color: white;
            transform: translateY(-2px);
            opacity: 0.95;
            text-decoration: none;
        }

        @media (max-width: 992px) {
            .peta-image {
                width: 92%;
                max-width: 820px;
                height: 340px;
            }
        }

        @media (max-width: 768px) {
            .peta-page {
                padding: 4px 10px 0;
            }

            .peta-card {
                padding: 8px 8px 10px;
            }

            .peta-title {
                font-size: 25px;
                margin-bottom: 8px;
            }

            .peta-image {
                width: 98%;
                height: 300px;
            }

            .btn-peta {
                padding: 8px 18px;
                font-size: 13px;
                min-width: 135px;
            }
        }
    </style>

    <div class="container-fluid px-0">

        @if (session('success') && Auth::check())
            <div class="alert alert-success mb-2">
                Login Berhasil, Selamat Belajar {{ Auth::user()->nama }}
            </div>
        @endif

        <div class="peta-page">
            <div class="peta-card">

                <h2 class="peta-title">
                    Peta Konsep
                </h2>

                <div class="peta-image-wrap">
                    <img src="{{ asset('img/petakonsep.png') }}"
                         alt="Peta Konsep Polinomial"
                         class="peta-image">
                </div>

                <div class="peta-button-group">
                    <a href="{{ asset('img/petakonsep.png') }}"
                       download
                       class="btn-peta">
                        Unduh Gambar
                    </a>

                    <a href="{{ asset('img/petakonsep.png') }}"
                       target="_blank"
                       class="btn-peta">
                        Buka Penuh
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('nav')
    <div></div>

    <a href="{{ route('pendahuluan') }}" class="btn-nav">
        Next →
    </a>
@endsection