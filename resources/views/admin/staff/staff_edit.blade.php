@extends('admin.admin_layout')

@section('content')

<div class="container">

    @if(session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Updated successfully!</strong> Your data has been updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row mt-4 h5">
        <div class="col-lg-10 col-md-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header alert-secondary h3">Update Staff</div>
                <div class="card-body">
                    <form action="{{route('staff.update',['id'=>$staff->id])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="">Staff Name</label>
                            <input type="text" name="name" class="form-control" value='{{$staff->name}}'>
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value='{{$staff->email}}'>
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
