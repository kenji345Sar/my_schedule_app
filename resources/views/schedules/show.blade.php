<x-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>{{ $schedule->title }}</h1>
    <p>Start Date: {{ $schedule->start_date }}</p>
    <p>End Date: {{ $schedule->end_date }}</p>
    <p>Created by: {{ $creator->name }}</p> <!-- Add the creator's name -->

    @if (Auth::id() != $schedule->user_id)
        <!-- Add the condition to show the error message -->
        <div class="alert alert-warning" role="alert">
            You are not the owner of this schedule. Please contact {{ $creator->name }} for any modifications.
        </div>
    @endif


    <div>
        <a href="{{ route('schedules.schedule_items.create', $schedule->id) }}" class="btn btn-primary">Add Schedule
            Item</a>
    </div>

    <h2>Schedule Items</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Location</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($schedule_items->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No schedule items found.</td>
                </tr>
            @else
                @foreach ($schedule_items as $item)
                    <tr>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->start_time }}</td>
                        <td>{{ $item->end_time }}</td>
                        <td>{{ $item->location }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <a href="{{ route('schedule_items.edit', $item->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('schedule_items.destroy', $item->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this schedule item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('Are you sure you want to delete this schedule?')">Delete</button>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary ml-3">戻る</a>
    </form>
    <br>
    {{-- <form action="{{ route('schedules.addUser', $schedule->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_email">Add user to schedule</label>
            <input type="email" name="user_email" id="user_email" class="form-control"
                placeholder="Enter user's email" required>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form> --}}



</x-layout>
