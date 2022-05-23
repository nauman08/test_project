@extends('layouts.app')

   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    Welcome ,You are Admin.
                </div>
                
            </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>
                            All Users
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Is Admin</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>                                
                                @foreach($users as $user)
                                    <tr>
                                        <td > {{ $user->name }} </td>
                                        <td> {{ $user->email }} </td>
                                        <td> {{ $user->is_admin }} </td>
                                        <td><a href="{{ route('remove', $user->id) }}"> Delete </a> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Register a new Admin</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('registerAdmin')}}" method="post" class="form-control">
                            @csrf
                            <label>User Name</label>
                            <input type="text" class="form-control" name="name">
                            <label>User Email</label>
                            <input type="text" class="form-control" name="email">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                            <button class="btn btn-primary" type="submit">Save </button>               
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection