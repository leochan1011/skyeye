@extends('layouts.app')

@section('content')

<style>
  .push-top {
    margin-top: 50px;
  }
</style>

<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="container">
    <table class="table">
        <thead>
            <tr class="table-primary">
              <td>ID</td>
              <td>Serial Number</td>
    
              <td class="text-center">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($drone as $uav)
            <tr>
                <td>{{$uav->DroneID}}</td>
                <td>{{$uav->DSerialNumber}}</td>
                <td class="text-center">
                    <a href="{{ route('drone.edit', $uav->DroneID)}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('drone.destroy', $uav->DroneID)}}" method="post" onsubmit="return confirm('Do you really want to delete this entry?');" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                      </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
  </div>

</div>
@endsection