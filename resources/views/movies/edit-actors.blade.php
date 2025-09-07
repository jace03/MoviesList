@extends('layouts.app')

@section('content')
    <h1>Add Actors to “{{ $movie->getTitle() }}”</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('movies.updateActors', $movie->getId()) }}">
        @csrf
        @method('PUT')

        <label for="actors">Select Actors</label>
        <select name="actors[]" id="actors" multiple size="8" style="width: 100%;">
            @foreach($allActors as $actor)
                <option
                    value="{{ $actor->getId() }}"
                    @if($movie->getActors()->contains($actor)) selected @endif
                >
                    {{ $actor->getName() }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-3">Save Actors</button>
    </form>
@endsection
