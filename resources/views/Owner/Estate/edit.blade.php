@extends('Owner.dashboard')
@section('content')
  <div class="container">
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger my-3">
          {{ $error }}
        </div>
      @endforeach
    @endif
    <div class="card my-3 ">
      <div class="card-header bg-dark text-light ">
        <h1 class="card-title">
          Estate information edit
        </h1>
      </div>
      <div class="card-body">
        <form action="{{ route('estates.update', $estate->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
            <label for="broker" class="form-label">Broker Name:</label>
            <input type="text" name="broker" id="broker" class="form-control" value="{{ $estate->broker }}"
              required>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Estate Type:</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $estate->type }}" required>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Estate Rental Price (USD):</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $estate->price }}"
              required>
          </div>
          <div class="mb-3">
            <label for="beds" class="form-label">Beds Number:</label>
            <input type="number" name="beds" id="beds" class="form-control" value="{{ $estate->beds }}" required>
          </div>
          <div class="mb-3">
            <label for="paths" class="form-label">Estate Paths:</label>
            <input type="number" name="paths" id="paths" class="form-control" value="{{ $estate->paths }}"
              required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Estate Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ $estate->address }}"
              required>
          </div>
          <div class="mb-3">
            <label for="state" class="form-label">Estate State:</label>
            <input type="text" name="state" id="state" class="form-control" value="{{ $estate->state }}"
              required>
          </div>
          <div class="mb-3">
            <label for="locality" class="form-label">Estate Locality:</label>
            <input type="text" name="locality" id="locality" class="form-control" value="{{ $estate->locality }}"
              required>
          </div>
          <div class="mb-3">
            <label for="sub-locality" class="form-label">Estate Sub-locality:</label>
            <input type="text" name="sub_locality" id="sub-locality" class="form-control"
              value="{{ $estate->sub_locality }}" required>
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">Estate Street:</label>
            <input type="text" name="street" id="street" class="form-control" value="{{ $estate->street_name }}"
              required>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
@endsection
