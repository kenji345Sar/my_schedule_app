<x-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
            @forelse ($schedules as $schedule)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $schedule->title }}</h5>
                            <p class="card-text">Start Date: {{ $schedule->start_date }}</p>
                            <p class="card-text">End Date: {{ $schedule->end_date }}</p>
                            <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-primary">Details</a>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-secondary">Edit</a>
                            <form class="d-inline" action="{{ route('schedules.destroy', $schedule->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
                            </form>
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
