@extends('Owner.dashboard')
@section('content')
<div class="container">
    <div class="card my-3 ">
        <div class="card-header bg-warning text-light ">
            <h1 class="card-title align-items-center mt-3">
                Type of estate: {{ $estate->type }}
            </h1>
        </div>
        <div class="card-body">
            <h3 class="mb-4">Real-Estate owner: <span class="text-warning">{{ $estate->owner }}</span> </h3>
            <h3 class="mb-4">Estate rental price: <span class="text-warning">{{ $estate->price }}</span> </h3>
            <h4 class="mb-4">Estate address: <span class="text-warning">{{ $estate->address }}</span> </h4>
            <h4 class="mb-4">Number of beds: <span class="text-warning">{{ $estate->beds }}</span> </h4>
            <h4 class="mb-4">Number of paths entry estate: <span class="text-warning">{{ $estate->paths }}</span> </h4>
            <h4 class="mb-4">State: <span class="text-warning">{{ $estate->state }}</span> </h4>
            <h4 class="mb-4">Locality: <span class="text-warning">{{ $estate->locality }}</span> </h4>
            <h4 class="mb-4">Sub-locality: <span class="text-warning">{{ $estate->sub_locality }}</span> </h4>
            <h4 class="mb-4">Street name: <span class="text-warning">{{ $estate->street_name }}</span> </h4>
            @if ($estate->broker != 'NoBroker')
            <h4 class="mb-4">Broker(if found): <span class="text-warning">{{ $estate->broker }}</span> </h4>
            @endif
            <h5 class="mb-4">Reserved: <span class="text-warning">{{ $estate->reserved }}</span> </h5>
            <h5 class="mb-4">Rented: <span class="text-warning">{{ $estate->rented }}</span> </h5>
            <a href="{{ route('estates.edit', $estate->id) }}" class="text-decoration-none"><button type="button"
                    class="btn btn-success px-5 ">Edit</button></a>
            <form action="{{ route('estates.destroy', $estate->id) }}" method="POST" class="d-inline-block ">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger px-5">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
