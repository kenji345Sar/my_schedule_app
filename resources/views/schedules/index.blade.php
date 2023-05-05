<x-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Schedules</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->title }}</td>
                        <td>{{ $schedule->start_date }}</td>
                        <td>{{ $schedule->end_date }}</td>
                        <td>
                            <a href="{{ route('schedules.show', $schedule) }}" class="btn btn-primary">Details</a>
                            <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-secondary">Edit</a>
                            <form class="d-inline" action="{{ route('schedules.destroy', $schedule) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No schedules found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
