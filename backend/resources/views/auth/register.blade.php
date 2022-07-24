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
                    {{-- <div class="form-group">
                        <div class="input-group d-flex">
                            <div class="input-group-prepend d-flex">
                                <i class="fas fa-user"></i>
                            </div>
                            <x-input type="text" name="username" placeholder="Username" autocomplete="off" required />
                        </div>
                    </div> --}}
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


                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-4 btn btn-rounded btn-info">
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>