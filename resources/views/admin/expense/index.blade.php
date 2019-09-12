<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Expense')

@push('css')
    <!-- data tables -->
    <link href="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}} " rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{ route('admin.expense.create') }}" id="addRow1" class="btn btn-primary" style="font-size:14px; padding: 6px 12px;">
                        Add New Expense <i style="color:white;" class="fa fa-plus"></i>
                    </a>

                </div>

            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>EXPENSE</header> <span class="btn btn-primary ml-1"> {{ $expenses->count() }} </span>

                </div>
                <div class="card-body ">
                    <div class="row p-b-20">
                        <div class="col-md-6 col-sm-6 col-6">

                        </div>
                        <div class="col-md-6 col-sm-6 col-6">

                        </div>
                    </div>
                    <header class="panel-heading panel-heading-gray custom-tab ">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#active" data-toggle="tab" class="active">Approved</a>
                            </li>
                            <li class="nav-item">
                                <a href="#pending" data-toggle="tab">Pending</a>
                            </li>

                        </ul>
                    </header>

                    <div class="tab-content">
                        {{-- Active --}}
                        <div class="tab-pane active" id="active">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="example4">
                                                <thead>
                                                <tr>

                                                    <th> Serial </th>
                                                    <th> Expense Head </th>
                                                    <th> Amount </th>
                                                    <th> Description </th>
                                                    <th> Recipient Name </th>
                                                    <th> Given Name </th>
                                                    <th> Created </th>
                                                    <th> Actions </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($expenses as $key=>$expense)
                                                    <tr class="odd gradeX">
                                                        <td> {{ $key+1 }} </td>
                                                        <td>

                                                            {{$expense->expensehead->name}}

                                                        </td>
                                                        <td>{{ $expense->amount }}</td>
                                                        <td>{{ $expense->description }}</td>
                                                        <td>{{ $expense->recipient_name }}</td>
                                                        <td>

                                                            {{$expense->user->name}}

                                                        </td>
                                                        <td>{{ $expense->created_at->toDayDateTimeString() }}</td>
                                                        <td>
                                                            <a  class="waves-effect btn btn-primary" href="{{ route('admin.expense.edit', $expense->id) }}"><i class="material-icons">edit</i></a>

                                                            <button type="submit" class="waves-effect btn deepPink-bgcolor"
                                                                    onclick="deleteExpense({{$expense->id}})">
                                                                <i class="material-icons">delete</i>
                                                            </button>

                                                            <form id="delete-form-{{$expense->id}}" action="{{ route('admin.expense.destroy', $expense->id) }}" method="post" style="display:none;">
                                                                @csrf
                                                                @method("DELETE")
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--Pending--}}
                        <div class="tab-pane" id="pending">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="card">

                                        <div class="card-body">
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="pending_expense">
                                                    <thead>
                                                    <tr>
                                                        <th> Serial </th>
                                                        <th> Expense Head </th>
                                                        <th> Amount </th>
                                                        <th> Description </th>
                                                        <th> Recipient Name </th>
                                                        <th> Given Name </th>
                                                        <th> Created </th>
                                                        <th> Actions </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($pending as $key=>$value)
                                                        <tr class="odd gradeX">
                                                            <td> {{ $key+1 }} </td>
                                                            <td>

                                                                {{$value->expensehead->name}}

                                                            </td>
                                                            <td>{{ $value->amount }}</td>
                                                            <td>{{ $value->description }}</td>
                                                            <td>{{ $value->recipient_name }}</td>
                                                            <td>

                                                                {{$value->user->name}}

                                                            </td>
                                                            <td>{{ $value->created_at->toDayDateTimeString() }}</td>
                                                            <td>
                                                                <a  class="waves-effect btn btn-primary" href="{{ route('admin.expense.edit', $value->id) }}"><i class="material-icons">edit</i></a>

                                                                <button type="submit" class="waves-effect btn deepPink-bgcolor"
                                                                        onclick="deleteExpense({{$value->id}})">
                                                                    <i class="material-icons">delete</i>
                                                                </button>

                                                                <form id="delete-form-{{$value->id}}" action="{{ route('admin.expense.destroy', $value->id) }}" method="post" style="display:none;">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- data tables -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/table/table_data.js') }}" ></script>
    <!-- sweet aleart -->
    <script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>

    <script type="text/javascript">

    function deleteExpense(id) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById("delete-form-"+id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your Branch name is safe :)',
                'error'
                )
            }
        })

    }

    </script>
@endpush


