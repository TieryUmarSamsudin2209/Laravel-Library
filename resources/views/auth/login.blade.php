@include('template.header')

<div class="container my-5 shadow p-3 rounded bg-light">
    <form method="POST" action="/login">
        @csrf
        <div class="title-page d-flex justify-content-between">
            <h1>LOGIN</h1>
            <div class="button d-flex justify-content-between">
                <div class="signin mx-2">
                    <a href="/register" class="btn btn-outline-primary">Sign In</a>
                </div>
                <div class="back mx-2">
                    <a href="/" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
        </div>
        @if (session('errorLogin'))
            <div class="alert alert-danger" role="alert">
                {{ session('errorLogin') }}
            </div>
        @endif
        @if (session('successRegister'))
            <div class="alert alert-success" role="alert">
                {{ session('successRegister') }}
            </div>
        @endif
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@include('template.footer')