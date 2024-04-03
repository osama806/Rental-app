@extends('Owner.dashboard')
@section('content')
  <div class="container">
    @foreach ($estates as $estate)
      <div class="card my-3 ">
        <a href="{{ route('estates.show', $estate->id) }}" class="text-decoration-none ">
          <div class="card-header bg-warning text-light ">
            <h1 class="card-title">
              Type of estate: {{ $estate->type }}
            </h1>
          </div>
        </a>
        <div class="card-body">
          <h3>Estate rental price: {{ $estate->price }} </h3>
          <h5>Number of beds: {{ $estate->beds }} </h5>
          <h5>Locality: {{ $estate->locality }} </h5>
        </div>
      </div>
    @endforeach
  </div>
@endsection
