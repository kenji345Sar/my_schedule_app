<x-layout>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Schedule</h1>

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ $schedule->title }}" required>
                    </div>

                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                            value="{{ date('Y-m-d\TH:i', strtotime($schedule->start_date)) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                            value="{{ date('Y-m-d\TH:i', strtotime($schedule->end_date)) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="users">関連するユーザー</label>
                        <select name="users[]" id="users" class="form-control" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ in_array($user->id, $schedule_users) ? 'selected' : '' }}>{{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Schedule</button>
                </form>

                <form method="POST" action="{{ route('schedules.destroy', $schedule->id) }}" class="mt-3">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this schedule?')">Delete
                        Schedule</button>
                </form>
                <!-- 戻るリンクを追加 -->
                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>
        </div>
    </div>

</x-layout>
