@extends('admin.admin_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-hover">
                <tr>
                    <th>Id</th>
                    <th>Staff Name</th>
                    <th>Email</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>

                @foreach ($staff as $s)
                    <tr>
                        <td>{{$s->id}}</td>
                        <td>{{$s->name}}</td>
                        <td>{{$s->email}}</td>
                        <td>{{$s->branch->branch_name}}</td>
                        <td>
                            <form action="{{route('staff.edit',['id'=>$s->id])}}" method='post'>
                                @csrf
                                <input type='submit' class="btn btn-success" value='edit'>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
