@extends('layouts.app')

@section('userinfo')

<div class="md-5">
    <table class="table">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Staff ID</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <th scope="row">#{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->role}}</td>
                <td>{{$item->sid}}</td>
            </tr>
            @endforeach
        </tbody>
    </table> 
    
</div>



@endsection