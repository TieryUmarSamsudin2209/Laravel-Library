@include('template.header')

<div class="container bg-light shadow mt-4 p-4 rounded">
    <div class="d-flex justify-content-center align-items-center" style="height: 300px;">
        <div class="text-center">
            <h1 class="display-4">Access Denied - Error 404</h1>
            <p class="lead text-danger">Only admins can access this page.</p>
            <a href="/" class="btn btn-danger">Go to Home</a>
        </div>
    </div>

</div>

@include('template.footer')