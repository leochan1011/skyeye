@extends('layouts.app')

@section('content')

<div class="card push-top">
  <div class="card-header">
    Edit & Update
  </div>

  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('drone.update', $drone->DroneID) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Serial Number</label>
              <!-- db column name -->
              <input type="text" class="form-control" name="SerialNum" value="{{ $drone->DSerialNumber }}"/>
          </div>

          <button type="submit" class="btn btn-block btn-primary">Update Drone</button>
      </form>
  </div>
</div>
@endsection