@extends('layouts.app')
<!-- Optional if you use a base layout -->

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-6">Change Password</h2>

    @if (session('success'))
    <div class="mb-4 text-green-600 font-medium">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">New Password</label>
            <input type="password" name="new_password" class="w-full p-2 border rounded" required>
            @error('new_password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update Password
        </button>
    </form>
</div>
@endsection