<form action="{{ route('password.update') }}" method="post">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="password" name="password">
        {{-- <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" /> --}}
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="password" name="password">
        {{-- <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" /> --}}
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password Confirmation</label>
        <input type="password" class="form-control" id="password" name="password_confirmation">
        {{-- <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" /> --}}
    </div>
    <div class="d-flex align-items-center gap-4">
        <button class="btn btn-primary">{{ __('Save') }}</button>
    
        @if (session('status') === 'password-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600"
            >Updated</p>
        @endif
    </div>
</form>