@include('template.header')

<div class="container my-5 shadow p-3 rounded bg-light">
    <form method="POST" action="/register">
        @csrf
        <div class="title-page d-flex justify-content-between">
            <h1>SIGN IN</h1>
            <div class="button d-flex justify-content-between">
                <div class="signin mx-2">
                    <a href="/login" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Enter your name" aria-describedby="nameHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter your email address" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" id="exampleInputPassword1" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@include('template.footer')