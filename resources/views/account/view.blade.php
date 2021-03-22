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
  
  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>Name</td>
          <td>Role</td>
          <td>Stuff ID</td>
          <td>Password</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($user as $users)
        <tr>
            <td>{{$users->UserID}}</td>
            <td>{{$users->UNAME}}</td>
            <td>{{$users->Role}}</td>
            <td>{{$users->SID}}</td>
            <td>{{$users->PWD}}</td>
            <td class="text-center">
                <a href="{{ route('users.edit', $users->UserID)}}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('users.destroy', $users->UserID)}}" method="post" style="display: inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"" type="submit">Delete</button>
                  </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection