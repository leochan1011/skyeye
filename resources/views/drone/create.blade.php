@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card push-top">
        <div class="card-header">
          Add Drone
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
            <form method="post" action="{{ route('drone.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="SN">Serial Number</label>
                    <input type="text" class="form-control" name="SerialNum"/>
                </div>
    
                <button type="submit" class="btn btn-block btn-primary">Create Drone</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection