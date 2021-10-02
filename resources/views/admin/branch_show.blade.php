@extends('admin.admin_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-hover">
                <tr>
                    <th>Id</th>
                    <th>Branch Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>

                @foreach ($branches as $b)
                    <tr>
                        <td>{{$b->id}}</td>
                        <td>{{$b->branch_name}}</td>
                        <td>{{$b->amount}}</td>
                        <td class='d-flex'>
                            {{-- <form action="{{route('branch.destroy',['id'=>$b->id])}}" method='post'>
                                @csrf
                                @method('delete');
                                <input type='submit' class="btn btn-danger" value='x'>
                            </form> --}}
                            <form action="{{route('branch.edit',['id'=>$b->id])}}" method='post'>
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
