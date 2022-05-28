<div class="row no-gutters justify-content-center">
    <div class="col-md-6">
        <!-- Login Form Start -->
        <div class="m-account--form-w">
            <div class="m-account--form">
                <!-- Logo Start -->
                <div class="logo">
                    <img src="assets/img/logo.png" alt="">
                </div>
                <!-- Logo End -->

                <form method="post" action="{{ route('login.action') }}">
                    @csrf
                    <input type="hidden" name="remember" value="0">
                    <label class="m-account--title">Login to your account</label>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="form-group">
                        <div class="input-group d-flex">
                            <div class="input-group-prepend d-flex">
                                <i class="fas fa-user"></i>
                            </div>
                            <x-input type="text" name="username" placeholder="Username" autocomplete="off" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group d-flex">
                            <div class="input-group-prepend d-flex">
                                <i class="fas fa-key"></i>
                            </div>
                            <x-input type="password" name="password" placeholder="Password" autocomplete="off" required />
                        </div>
                    </div>

                    <div class="m-account--actions">
                        <a href="#" class="btn-link">Forgot Password?</a>

                        <button type="submit" class="btn btn-rounded btn-info">Login</button>
                    </div>

                    {{-- <div class="m-account--alt">
                        <p><span>OR LOGIN WITH</span></p>

                        <div class="btn-list">
                            <a href="#" class="btn btn-rounded btn-warning">Facebook</a>
                            <a href="#" class="btn btn-rounded btn-warning">Google</a>
                        </div>
                    </div> --}}

                    <div class="m-account--footer">
                        <p>&copy; 2018 ThemeLooks</p>
                    </div>
                </form>
            </div>
        </div>
        <!-- Login Form End -->
    </div>
</div>