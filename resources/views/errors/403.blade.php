<x-layout>
    <x-slot name="title">
        403 - Forbidden
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">403 - Forbidden</h1>
        <p>You are not the owner of this schedule. Please contact the creator for any modifications.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go back to dashboard</a>
    </div>
</x-layout>
