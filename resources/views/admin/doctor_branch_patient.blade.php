@extends('admin.admin_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-hover">
                <tr>
                    <th>Id</th>
                    <th>Patient Name</th>
                    <th>Problem</th>
                    <th>Fee</th>
                </tr>

                @foreach ($patient as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td class='fw-bold'>
                            {{($p->pro!=null)?$p->pro->problem:null}}
                            :-<br>
                            <small class="lead">{{($p->pro!=null)?$p->pro->problem_descr:null}}</small>
                        </td>/td>
                        <td >Rs. {{$p->branch->amount}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection
