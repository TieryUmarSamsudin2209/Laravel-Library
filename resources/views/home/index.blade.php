@extends('template.header')
@section('title', 'Home')

@section('content')
<nav>
    <div class="left">
        <div class="logo">
            <h1>Library</h1>
        </div>
    </div>
    <div class="center">
        <div class="menu-link-navbar">
            <a href="/" class="active"><i class="fa-solid fa-house"></i> Home</a>
            <a href="/book"><i class="fa-solid fa-book"></i> Book</a>
        </div>
    </div>
    <div class="right">
        <div class="btn-login">
            <a href="/login">Login</a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="welcome-section">
        <h2>Welcome To Our Library</h2>
        <p>Discover a world of knowledge and imagination in our digital library.</p>
    </div>
    <div class="search-box">
        <div class="search-wrapper">
            <input type="text" placeholder="Search for books, authors, or genres...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
</div>

@include('template.footer')
@endsection