@include('template.header')

<div class="cancel-btn">
    <a href="/"><i class="fa-solid fa-xmark"></i></a>
</div>
<div class="container">
    <div class="login-form">
        <form method="post">
            @csrf
            <div class="form-title">
                <h2>Login</h2>
                <p>Welcome, Please login to your registered account!</p>
            </div>
            <div class="form-data">
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email address">
                </div>
                <div class="input-box">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                        <button id="showPass"><i class="fa-solid fa-eye"></i></button>
                    </div>
                </div>
                <div class="login-btn">
                    <input type="submit" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>

@include('template.footer')