@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card push-top">
        <div class="card-header">
          Add User
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
            <form method="post" action="{{ route('users.store') }}">
                <div class="form-group">
                    <label for="sid">Stuff ID</label>
                    <input type="text" class="form-control" name="sid"/>
                </div>
                <div class="form-group">
                    @csrf
                    <label for="name">User name</label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" name="password"/>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ old('role') }}" required autocomplete="role">>
                      <option selected ></option>
                      <option>admin</option>
                      <option>crew</option>
                    </select>

                </div>

                <button type="submit" class="btn btn-block btn-danger">Create User</button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection