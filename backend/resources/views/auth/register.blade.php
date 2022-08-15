<div class="row no-gutters justify-content-center">
    <div class="col-md-6">
        <div class="m-account--form-w">
            <div class="m-account--form">
                <div class="logo">
                    <img src="assets/img/logo.png" alt="">
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <label class="m-account--title">Create new account</label>
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="mt-4">
                        <x-label for="name" :value="__('Name')" />

                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    </div>
                    <div class="mt-4">
                        <x-label for="username" :value="__('Username')" />

                        <x-input id="username" class="block mt-1 w-full" type="username" name="username" :value="old('username')" required />
                    </div>
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="secret_key" :value="__('Secret Key')" />

                        <x-input id="secret_key" class="block mt-1 w-full"
                                        type="password"
                                        name="secret_key"
                                        required autocomplete="new-secret-key" />
                    </div>

                    <input type="hidden" name="type" value="superadmin">
                    <input type="hidden" name="photo" value="NULL">

                    <div class="m-account--actions">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="btn btn-rounded btn-info">Register</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>