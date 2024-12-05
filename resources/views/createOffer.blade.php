@extends('layout.app')

@section('content')
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>

    <form action="{{ route('storeOffer') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <input type="text" class="form-control" id="company" name="company" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control" id="url" name="url" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" required>
                <option selected disabled>Select a status</option>
                <option value="progress">In progress</option>
                <option value="finished">FInished</option>
              </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3">Create</button>
            <button type="reset" class="btn btn-info mb-3">Reset</button>
        </div>
    </form>
@endsection
