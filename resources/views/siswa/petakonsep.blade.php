@extends('layout.halamanmateri')

@section('content')
    <style>
        .peta-page {
            width: 100%;
            padding: 0 6px 16px;
            box-sizing: border-box;
        }

        .peta-card {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 6px 6px 10px;
            box-sizing: border-box;
            text-align: center;
        }

        .peta-image-section {
            width: 100%;
            min-height: calc(100vh - 145px);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .peta-image-wrap {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .peta-image {
            width: 100%;
            max-width: 1300px;
            height: auto;
            max-height: calc(100vh - 170px);
            object-fit: contain;
            display: block;
            border-radius: 14px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.08);
            background: #ffffff;
        }

        .peta-button-group {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 12px;
            padding-bottom: 0;
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
            .peta-page {
                padding: 0 6px 14px;
            }

            .peta-card {
                max-width: 100%;
                padding: 6px 6px 10px;
            }

            .peta-image-section {
                min-height: calc(100vh - 140px);
            }

            .peta-image {
                width: 100%;
                max-width: 100%;
                max-height: calc(100vh - 165px);
            }
        }

        @media (max-width: 768px) {
            .peta-page {
                padding: 0 4px 12px;
            }

            .peta-card {
                padding: 4px 4px 8px;
            }

            .peta-image-section {
                min-height: calc(100vh - 135px);
            }

            .peta-image {
                width: 100%;
                max-width: 100%;
                max-height: calc(100vh - 160px);
                border-radius: 12px;
            }

            .peta-button-group {
                gap: 10px;
                margin-top: 10px;
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

                <div class="peta-image-section">
                    <div class="peta-image-wrap">
                        <img src="{{ asset('img/petakonsepp.png') }}"
                             alt="Peta Konsep Polinomial"
                             class="peta-image">
                    </div>
                </div>

                <div class="peta-button-group">
                    <a href="{{ asset('img/petakonsepp.png') }}"
                       download
                       class="btn-peta">
                        Unduh Gambar
                    </a>

                    <a href="{{ asset('img/petakonsepp.png') }}"
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