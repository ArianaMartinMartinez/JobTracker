@extends('layout.app')

@section('content')
    <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
    <div class="offerInfo">
        <div>
            <h3>{{ $offer->title }}</h3>
            <h5>{{ $offer->company }}</h5>
        </div>
        <div>
            <a href="{{ $offer->url }}">Link to the offer</a>
            <p>{{ $offer->status }}</p>
        </div>
    </div>

    <div class="offerProgress">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date</th>
                    <th scope="col">Comment</th>
                </tr>
            </thead>
            <tbody>
                @if (!($offer->progresses)->isEmpty())
                    @foreach ($offer->progresses as $progress)
                        <tr>
                            <td>{{ $progress->id }}</td>
                            <td>{{ $progress->created_at }}</td>
                            <td>{{ $progress->comment }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3">There's no progress yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection