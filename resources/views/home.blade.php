@extends('layout.app')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Title</th>
                <th scope="col">Company</th>
                <th scope="col">URL</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
                <tr>
                    <td>{{ $offer->id }}</td>
                    <td>{{ $offer->created_at }}</td>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->company }}</td>
                    <td>
                        <a href="{{ $offer->url }}" target="_blank">Link to the offer</a>
                    </td>
                    <td>{{ $offer->status }}</td>
                    <td>
                        <a href="{{ route('showDetail', ['id' => $offer->id]) }}" class="btn btn-info">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection