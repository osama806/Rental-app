   @extends('Owner.dashboard')
   @section('content')
     <div class="container">
       <div class="card my-3 ">
         <div class="card-header bg-dark text-light ">
           <h1 class="card-title">
             Type of estate: {{ $estate->type }}
           </h1>
         </div>
         <div class="card-body">
           <h3 class="mb-4">Estate rental price: {{ $estate->price }} </h3>
           <h5 class="mb-4">Estate address: {{ $estate->address }} </h5>
           <h5 class="mb-4">Number of beds: {{ $estate->beds }} </h5>
           <h5 class="mb-4">Number of paths entry estate: {{ $estate->paths }} </h5>
           <h5 class="mb-4">State: {{ $estate->state }} </h5>
           <h5 class="mb-4">Locality: {{ $estate->locality }} </h5>
           <h5 class="mb-4">Sub-locality: {{ $estate->sub_locality }} </h5>
           <h5 class="mb-4">Street name: {{ $estate->street_name }} </h5>
           @if ($estate->broker != 'NoBroker')
             <h5 class="mb-4">Broker(if found): {{ $estate->broker }} </h5>
           @endif
           <h6 class="mb-4">Reserved: {{ $estate->reserved }} </h6>
           <h6 class="mb-4">Rented: {{ $estate->rented }} </h6>
           <a href="{{ route('estates.edit', $estate->id) }}" class="text-decoration-none"><button type="button"
               class="btn btn-success px-5 ">Edit</button></a>
           <form action="{{ route('estates.destroy', $estate->id) }}" method="POST" class="d-inline-block ">
             @csrf
             @method('DELETE')
             <button type="button" class="btn btn-danger px-5">Delete</button>
           </form>
         </div>
       </div>
     </div>
   @endsection
