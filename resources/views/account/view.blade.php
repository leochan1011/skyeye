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
    <div style="margin-bottom: 10px;" class="row">
      <div class="col-lg-12">
          <a class="btn btn-success" href="users/create">
              Add User
          </a>
      </div>
    </div>
    <table class="table">
      <thead>
          <tr class="table-warning">
            <td>ID</td>
            <td>Name</td>
            <td>Staff ID</td>
            <td>Role</td>
            <td>Status</td>
            <td class="text-center">Action</td>
          </tr>
      </thead>
      <tbody>
          @foreach($user as $users)
          <tr>
              <td>{{$users->id}}</td>
              <td>{{$users->UNAME}}</td>
              <td>{{$users->SID}}</td>
              <td>{{$users->Role}}</td>
              <td><span class="badge rounded-pill bg-success">{{$users->Status == 0 ? 'Active' : 'Offline'}}</span></td>
              <td class="text-center">
                  <a href="{{ route('users.edit', $users->id)}}" class="btn btn-primary btn-sm">Edit</a>
                  <form action="{{ route('users.destroy', $users->id)}}" method="post" onsubmit="return confirm('Do you really want to delete this entry?');" style="display: inline-block">
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
@endsection