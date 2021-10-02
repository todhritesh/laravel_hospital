@extends('admin.admin_layout')

@section('content')

<div class="container">

    @if(session()->has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Updated Successfully!</strong> The doctor has been updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row mt-4 h5">
        <div class="col-lg-10 col-md-8 mx-auto">
            <div class="card shadow-lg">
                <div class="card-header alert-secondary h3">Add Doctor</div>
                <div class="card-body">
                    <form action="{{route('doctor.update',['id'=>$doctor->id])}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control" value="{{$doctor->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control" value="{{$doctor->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="">Branch</label>
                            <select name="branch" id="" class="form-select">
                                @foreach ($branch as $b)
                                    <option value="{{$b->id}}">{{$b->branch_name}}</option>
                                @endforeach
                            </select>
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
