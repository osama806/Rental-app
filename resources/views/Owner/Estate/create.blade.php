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
    @if (Session::has('msg'))
      <div class="alert alert-danger text-light my-3">
        {{ Session::get('msg') }}
      </div>
    @endif
    <div class="card my-3 ">
      <div class="card-header bg-warning text-light ">
        <h1 class="card-title">
          Estate create
        </h1>
      </div>
      <div class="card-body">
        <form action="{{ route('estates.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="broker" class="form-label">Broker Name:</label>
            <input type="text" name="broker" id="broker" class="form-control" value="{{ old('broker') }}" required>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Estate Type:</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ old('type') }}" required>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label">Estate Rental Price (USD):</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
          </div>
          <div class="mb-3">
            <label for="beds" class="form-label">Beds Number:</label>
            <input type="number" name="beds" id="beds" class="form-control" value="{{ old('beds') }}" required>
          </div>
          <div class="mb-3">
            <label for="paths" class="form-label">Estate Paths:</label>
            <input type="number" name="paths" id="paths" class="form-control" value="{{ old('paths') }}" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Estate Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
              required>
          </div>
          <div class="mb-3">
            <label for="state" class="form-label">Estate State:</label>
            <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}" required>
          </div>
          <div class="mb-3">
            <label for="locality" class="form-label">Estate Locality:</label>
            <input type="text" name="locality" id="locality" class="form-control" value="{{ old('locality') }}"
              required>
          </div>
          <div class="mb-3">
            <label for="sub-locality" class="form-label">Estate Sub-locality:</label>
            <input type="text" name="sub_locality" id="sub-locality" class="form-control"
              value="{{ old('sub_locality') }}" required>
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">Estate Street:</label>
            <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}"
              required>
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
@endsection
