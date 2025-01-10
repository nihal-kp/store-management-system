@extends('layouts.app')

@section('content')
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
    <div class="mobile-menu-handle"></div>
    <div class="container">
    <!-- Button trigger modal -->
        <div class="right-home">
            <h1>Dashboard</h1>
            <div class="bg1">
            <!-- <img src="images/top-img.png"> -->
            <div class="top-ctry-sec">
            <h5 style="float: right;">Current Location: {{ $userLocation }}</h5><br>
            <h4>Nearest <span>Stores</span></h4>

            <ul id="stores-list">
                @foreach($stores as $store)
                <li>
                    <h3>{{ $store->name }}</h3>
                    <p>Address: {{ $store->address }}</p>
                    <p>Distance: {{ number_format($store->distance, 2) }} km</p>
                </li>
                <br>
                @endforeach
            </ul>
            
            </div>
            </div>

            <div class="ftr-last">
                <p>Store Management System | Powered by <a href="#">Nihal K P</a></p>
            </div>
        </div>
    </div>
@endsection