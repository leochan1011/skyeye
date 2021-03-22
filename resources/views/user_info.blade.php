@extends('layouts.app')

@section('userinfo')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Role</th>
              <th scope="col">Staff ID</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $item)
              <tr>
                  <th scope="row">{{$item->UserID}}</th>
                  <td>{{$item->UNAME}}</td>
                  <td>{{$item->Role}}</td>
                  <td>{{$item->SID}}</td>
              </tr>
              @endforeach
          </tbody>
      </table> 
      
  </div>
  </div>
</div>




@endsection