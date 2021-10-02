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
                <div class="card-header alert-secondary h3">Register Patient</div>
                <div class="card-body">
                    <form action="{{route('patient.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Problem</label>
                            <input type="text" name="problem" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Problem Description</label>
                            <textarea name="problem descr" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="">password</label>
                            <input type="password" name="password" class="form-control">
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label for="">Branch</label>
                            <select name="branch" id="" class="form-select">
                                @foreach ($branch as $b)
                                    <option value="{{$b->id}}">{{$b->branch_name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
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
