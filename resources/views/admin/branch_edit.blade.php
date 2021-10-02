@extends('admin.admin_layout')

@section('content')

<div class="container">

    @if(session()->has('msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row mt-4 h5">
        <div class="col-lg-10 col-md-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header alert-secondary h3">Edit Branch</div>
                <div class="card-body">
                    <form action="{{route('branch.update',['id'=>$branch->id])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="">Branch Name</label>
                            <input type="text" name="name" class="form-control" value='{{$branch->branch_name}}'>
                        </div>
                        <div class="mb-3">
                            <label for="">Amount</label>
                            <input type="text" name="amount" class="form-control" value='{{$branch->amount}}'>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-success w-50 font-weight-bold">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
