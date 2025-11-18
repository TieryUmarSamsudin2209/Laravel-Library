@include('template.header')

<div class="container my-5 shadow p-3 rounded">
    <form>
        @csrf
        <div class="title-page d-flex justify-content-between">
            <h1>REGISTER</h1>
            <div class="button d-flex justify-content-between">
                <div class="signin mx-2">
                    <a href="/login" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">Name</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Enter your name" aria-describedby="nameHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter your email address" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" placeholder="Enter your password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@include('template.footer')