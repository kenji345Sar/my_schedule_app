<x-layout>
    <x-slot name="title">
        Create Schedule
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Create Schedule</h1>

        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route('schedules.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title"
                            class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                            required maxlength="255">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                            class="form-control @error('start_date') is-invalid @enderror"
                            value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}"
                            required>
                        @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="mb-3">
                        <label for="memo" class="form-label">Memo</label>
                        <textarea name="memo" id="memo"
                            class="form-control @error('memo') is-invalid @enderror">{{ old('memo') }}</textarea>
                        @error('memo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label for="users">関連するユーザー</label>
                        <select name="users[]" id="users" class="form-control" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>

</x-layout>
