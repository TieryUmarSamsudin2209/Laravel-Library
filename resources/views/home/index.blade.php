@include('template.header')

<nav>
    <div class="nav-body d-flex justify-content-between p-3 align-items-center bg-light">
        <div class="title">
            <h1>LIBRARY</h1>
        </div>
        <div class="menu">
                @if(Auth::check())
                    <a href="/" class="text-decoration-none mx-1">Home</a>
                    <a href="/admin/book" class="text-decoration-none mx-1">Book</a>
                    <a href="/admin/borrow" class="text-decoration-none mx-1">Borrow Book</a>
                    <a href="/admin/category" class="text-decoration-none mx-1">Category Book</a>
                @else
                    <a href="/" class="text-decoration-none mx-1">Home</a>
                    <a href="/admin/book" class="text-decoration-none mx-1">Book</a>
                @endif
        </div>
        <div class="auth">
            @if(Auth::check())
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            @else
                <a href="/login" class="btn btn-outline-primary">Login</a>
                <a href="/register" class="btn btn-primary">Sign In</a>
            @endif
        </div>
    </div>
</nav>
<div class="container my-5 p-2 rounded bg-light text-center">
    <div class="title-body">
        @if(Auth::check())
            @php
                $roleName = 'Member';
                if(method_exists(Auth::user(), 'role') && Auth::user()->role->isNotEmpty()){
                    $roleName = Auth::user()->role->first()->role_name;
                }
            @endphp
            <h3 class="text-center">Welcome, {{ Auth::user()->name }} <small class="text-muted">({{ ucfirst($roleName) }})</small></h3>
            <p>Welcome back — browse our collection and borrow the books you like.</p>
        @else
            <h3 class="text-center">Welcome To Our Library Website</h3>
            <p>Please take a look, if there is a book you are interested in, you can borrow it.</p>
        @endif
    </div>
    <div class="quick-link">
        @if(Auth::check())
            <a href="/admin/book" class="btn btn-primary">Book</a>
        @else
            <span class="text-danger">Please login first to access more!!</span>
        @endif
    </div>
</div>

@include('template.footer')
