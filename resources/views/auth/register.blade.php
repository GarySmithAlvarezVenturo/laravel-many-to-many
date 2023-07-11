@extends('Guest.layouts.base')

@section('contents')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input 
            type="text" 
            class="form-control" 
            id="name" 
            aria-describedby="emailHelp" 
            name="name"  
            required autofocus 
            autocomplete="username"
            value="{{ old('name') }}">
        </div>

        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input 
            type="email" 
            class="form-control" 
            id="email" 
            aria-describedby="emailHelp" 
            name="email"  
            required autofocus 
            autocomplete="username"
            value="{{ old('name') }}" >
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input 
            type="password" 
            class="form-control" 
            id="password" 
            name="password" 
            required autocomplete="current-password">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
        </div> --}}

        <a href="{{ route('password.request') }}">
            Forgot your password?
        </a>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection