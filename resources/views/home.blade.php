@extends('layout.app')

@section('content')
    <table class="table table-bordered container" id="table">
        <thead>
            <tr>
                <th scope="col" id="headerTable">#</th>
                <th scope="col" id="headerTable">Date</th>
                <th scope="col" id="headerTable">Last Update</th>
                <th scope="col" id="headerTable">Title</th>
                <th scope="col" id="headerTable">Company</th>
                <th scope="col" id="headerTable">URL</th>
                <th scope="col" id="headerTable">Status</th>
                <th scope="col" id="headerTable">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offers as $offer)
                <tr>
                    <th>{{ $offer->id }}</th>
                    <td>{{ $offer->created_at }}</td>
                    <td>{{ $offer->lastestProgress->updated_at ?? "There's no progress yet" }}</td>
                    <td>{{ $offer->title }}</td>
                    <td>{{ $offer->company }}</td>
                    <td>
                        <a href="{{ $offer->url }}" target="_blank">Link to the offer</a>
                    </td>
                    <td>{{ $offer->status }}</td>
                    <td>
                        <a href="{{ route('showDetail', ['id' => $offer->id]) }}">
                            <button type="button" class="btn btn-warning">Details</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection