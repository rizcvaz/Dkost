@extends('layouts.admin')

@section('content')

<main>
    <div class="header">
        <div class="left">
            <h1>Dashboard</h1>
            {{-- <ul class="breadcrumb">
                <li><a href="#">
                        Analytics
                    </a></li>
                /
                <li><a href="#" class="active">Shop</a></li>
            </ul> --}}
        </div>
        <a href="#" class="report">
            <i class='bx bx-cloud-download'></i>
            <span>Download CSV</span>
        </a>
    </div>


@endsection