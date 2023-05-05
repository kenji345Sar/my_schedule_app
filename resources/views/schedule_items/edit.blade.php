<x-layout>
    <x-slot name="title">
        Edit Schedule Item
    </x-slot>

    <h1>Edit Schedule Item</h1>

    <form method="post" action="{{ route('schedule_items.update', $schedule_item->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="item_name">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="form-control"
                value="{{ $schedule_item->item_name }}" required>
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control"
                value="{{ $schedule_item->start_time }}" required>
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control"
                value="{{ $schedule_item->end_time }}" required>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control"
                value="{{ $schedule_item->location }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $schedule_item->description }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Update Item</button>
        </div>
    </form>
    <a href="{{ route('schedules.show', $schedule_item->schedule_id) }}" class="btn btn-secondary">戻る</a>

</x-layout>
