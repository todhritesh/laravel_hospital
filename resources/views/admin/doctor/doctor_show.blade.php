@extends('admin.admin_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-hover">
                <tr>
                    <th>Id</th>
                    <th>Doctor Name</th>
                    <th>Email</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>

                @foreach ($doctor as $d)
                    <tr>
                        <td>{{$d->id}}</td>
                        <td>{{$d->name}}</td>
                        <td>{{$d->email}}</td>
                        <td>{{$d->branch->branch_name}}</td>
                        <td class='d-flex'>
                            <form action="{{route('doctor.delete',['id'=>$d->id])}}" method='post'>
                                @csrf
                                @method('delete');
                                <input type='submit' class="btn btn-danger" value='x'>
                            </form>
                            <form action="{{route('doctor.edit',['id'=>$d->id])}}" method='post'>
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
