@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                {{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="flex">

    <div class="image-login w-3/5 h-screen">
        <img src="/img/login-img.png" alt="" class="w-full h-full">
    </div>

    <div class="login-form bg-gray-300 w-2/5 h-screen px-24 py-6">

        <div class="w-full bg-gray-300 h-full ">

            <div class="flex items-center justify-end">
                <a href="/">
                    <button class="bg-white relative w-8 h-8 hover:shadow-outline rounded-full p-1 text-gray-800 focus:outline-none">
                        <svg class=" w-4 mx-auto" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </a>
            </div>

            <div class="mt-16 w-1/2 flex flex-wrap">
                <span class="text-blue-600 font-bold leading-tight">
                    Please sign in
                    <span class="text-blue-400 font-semibold leading-tight">
                        to experience the most of our service!
                    </span>
                </span>
            </div>

            <div class="border-t border-gray-400 w-full my-8"></div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex flex-col">
                    <div class="mb-4 flex items-center relative">
                        <input id="email" type="email" name="email" placeholder="Email (example@gmail.com)" class="rounded-lg py-3 px-4 text-gray-700 border border-gray-300 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <svg class="w-4 absolute right-0 mr-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <div>
                        @error('email')
                            <span class="text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="mb-4 flex items-center relative">
                        <input id="password" type="password" name="password" placeholder="Password" class="rounded-lg py-3 px-4 text-gray-700 border border-gray-300 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full" required autocomplete="current-password">
                        <svg class="w-4 absolute right-0 mr-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div>
                        @error('password')
                            <span class="text-red-400" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="stay flex items-center justify-between mb-8">

                    <div class="flex items-center">
                        <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                            <input name="remember" id="remember" type="checkbox" class="opacity-0 absolute" {{ old('remember') ? 'checked' : '' }}>
                            <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20">
                                <path d="M0 11l2-2 5 5L18 3l2 2L7 18z" />
                            </svg>
                        </div>
                        <label for="remember" class="text-gray-500 font-semibold">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            <span class="text-blue-700 font-bold hover:text-blue-400">
                               {{ __('Forgot Your Password?') }}
                            </span>
                        </a>
                        @endif
                    </div>

                </div>

                <div>
                    <button type="submit" class="px-6 py-2 w-full rounded-lg hover:bg-orange-400 bg-orange-custom text-white font-semibold leading-tight">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>

            <div class="border-t border-gray-400 w-full my-8"></div>

            <div class="flex">
                <div class="mr-6"><span class="text-gray-500 font-semibold">Don't have an account?</span></div>
                <div>
                    <a href="/register">
                        <span class="text-blue-600 font-bold hover:text-blue-400">Sign Up</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div> --}}

{{-- <div class="bg-gray-100">
    <login-page></login-page>
</div> --}}
@endsection
