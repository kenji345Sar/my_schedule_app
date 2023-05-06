<x-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>

    <div class="container mt-5">
        <div class="d-flex justify-content-end">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-decoration-none">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
        <h1 class="mb-4">Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}!</p>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Add Schedule</a>
        <div class="row">
            @forelse ($schedules as $schedule)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $schedule->title }}</h5>
                            <p class="card-text">Start Date: {{ $schedule->start_date }}</p>
                            <p class="card-text">End Date: {{ $schedule->end_date }}</p>
                            <div class="d-flex">
                                <a href="{{ route('schedules.show', $schedule->id) }}"
                                    class="btn btn-primary me-2">Details</a>
                                <a href="{{ route('schedules.edit', $schedule->id) }}"
                                    class="btn btn-secondary me-2">Edit</a>
                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No schedules yet!
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
