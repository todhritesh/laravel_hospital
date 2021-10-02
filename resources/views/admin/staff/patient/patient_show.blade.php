@extends('admin.admin_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-hover">
                <tr>
                    <th>Id</th>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Problem</th>
                    <th>Appointment Branch</th>
                    <th>Action</th>
                </tr>

                @foreach ($patient as $p)
                    <tr class="small">
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->email}}</td>
                        <td class='fw-bold'>
                            {{($p->pro!=null)?$p->pro->problem:null}}
                            :-<br>
                            <small class="lead small">{{($p->pro!=null)?$p->pro->problem_descr:null}}</small>
                        </td>
                        <td>{{$p->branch->branch_name}}</td>
                        <td class='d-flex'>
                            <form action="{{route('patient.edit',['id'=>$p->id])}}" method='post'>
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
