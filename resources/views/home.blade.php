@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are normal user.
                </div>
            </div>
            <div class="card mt-3">
                    <div class="card-header">
                        <h3>Place an order for fidgets</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('solution')}}" method="post" class="form-control">
                            @csrf
                            <label>Enter Fidget Quantity</label>
                            <input type="text" class="form-control" name="fidget">
                            <button class="btn btn-primary pl-3 pr-3 mt-3" type="submit"> Submit </button>               
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection