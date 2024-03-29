@extends('layouts.app')

@section('content')
<div class="container">
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
    
      <form method="post" action="{{ route('users.update', $user->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">User name</label>
              <input type="text" class="form-control" name="name" value="{{ $user->UNAME }}"/>
          </div>
          <div class="form-group">
              <label for="sid">Staff ID</label>
              <input type="text" class="form-control" name="sid" value="{{ $user->SID }}"/>
          </div>
          <div class="form-group">
              <label for="role">Role</label>
              <select name="role" class="form-control" name="role" value="{{ $user->Role }}" >
                <option selected ></option>
                <option>admin</option>
                <option>user</option>
              </select>

          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="text" class="form-control" name="password" />
          </div>
          <button type="submit" class="btn btn-block btn-primary">Update User</button>
      </form>
  </div>
</div>
</div>
@endsection