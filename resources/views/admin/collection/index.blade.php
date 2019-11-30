<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Collections')

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
                    <a href="{{ route('admin.collection.create') }}" id="addRow1" class="btn btn-primary" style="font-size:14px; padding: 6px 12px;">
                        Make Collection <i style="color:white;" class="fa fa-plus"></i>
                    </a>

                </div>

            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>COLLECTION</header> <span class="btn btn-primary ml-3"> {{ $collections->count() }} </span>

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
                                                    <th> Farmer / Purpose </th>
                                                    <th> Collection Amount </th>
                                                    <th> Collection Type </th>
                                                    <th> Given By </th>
                                                    <th> Collection Date</th>
                                                    <th> Action </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($collections as $key=>$collection)
                                                    <tr class="odd gradeX">
                                                        <td> {{ $key+1 }} </td>
                                                        <td>
                                                            @if ($collection->collect_type == 'farmer')
                                                                {{ $collection->farmer->name }}
                                                            @endif

                                                            @if (is_null($collection->farmer_id))
                                                                {{ ucwords($collection->collect_type) }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $collection->collection_amount }}</td>
                                                        <td>{{ $collection->collection_type }}</td>
                                                        <td>{{ $collection->given_by }}</td>
                                                        <td>{{ Carbon::parse($collection->collectin_date)->toDayDateTimeString() }}</td>
                                                        {{--
                                                        <td>{{ Carbon::parse($farmer->ending_date)->toDayDateTimeString() }}</td> --}}
                                                        <td>
                                                            <a  class="waves-effect btn btn-success" href="{{ route('admin.collection.show', $collection->id) }}"><i class="material-icons">visibility</i></a>
                                                            @role('superadmin')
                                                            <a  class="waves-effect btn btn-primary" href="{{ route('admin.collection.edit', $collection->id) }}"><i class="material-icons">edit</i></a>

                                                            <button type="submit" class="waves-effect btn deepPink-bgcolor"
                                                                    onclick="deleteCollection({{$collection->id}})">
                                                                <i class="material-icons">delete</i>
                                                            </button>

                                                            <form id="delete-form-{{$collection->id}}" action="{{ route('admin.collection.destroy', $collection->id) }}" method="post" style="display:none;">
                                                                @csrf
                                                                @method("DELETE")
                                                            </form>
                                                            @endrole
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th> Serial </th>
                                                    <th> Company / Farmer </th>
                                                    <th> Collection Amount </th>
                                                    <th> Collection Type </th>
                                                    <th> Given By </th>
                                                    <th> Collection Date</th>
                                                    <th> Action </th>
                                                </tr>
                                                </tfoot>
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
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="pending_collection">
                                                    <thead>
                                                    <tr>
                                                        <th> Serial </th>
                                                        <th> Farmer / Purpose </th>
                                                        <th> Collection Amount </th>
                                                        <th> Collection Type </th>
                                                        <th> Given By </th>
                                                        <th> Collection Date</th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($pending as $key=>$value)
                                                        <tr class="odd gradeX">
                                                            <td> {{ $key+1 }} </td>
                                                            <td>
                                                                @if ($value->collect_type == 'farmer')
                                                                    {{ $value->farmer->name }}
                                                                @endif

                                                                @if (is_null($value->farmer_id))
                                                                    {{ ucwords($value->collect_type) }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $value->collection_amount }}</td>
                                                            <td>{{ $value->collection_type }}</td>
                                                            <td>{{ $value->given_by }}</td>
                                                            <td>{{ Carbon::parse($value->collectin_date)->toDayDateTimeString() }}</td>
                                                            {{--
                                                            <td>{{ Carbon::parse($farmer->ending_date)->toDayDateTimeString() }}</td> --}}
                                                            <td>
                                                                <a  class="waves-effect btn btn-success" href="{{ route('admin.collection.show', $value->id) }}"><i class="material-icons">visibility</i></a>
                                                                @role('superadmin')
                                                                <a  class="waves-effect btn btn-primary" href="{{ route('admin.collection.edit', $value->id) }}"><i class="material-icons">edit</i></a>

                                                                <button type="submit" class="waves-effect btn deepPink-bgcolor"
                                                                        onclick="deleteCollection({{$value->id}})">
                                                                    <i class="material-icons">delete</i>
                                                                </button>

                                                                <form id="delete-form-{{$value->id}}" action="{{ route('admin.collection.destroy', $value->id) }}" method="post" style="display:none;">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                </form>
                                                                @endrole
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th> Serial </th>
                                                        <th> Company / Farmer </th>
                                                        <th> Collection Amount </th>
                                                        <th> Collection Type </th>
                                                        <th> Given By </th>
                                                        <th> Collection Date</th>
                                                        <th> Action </th>
                                                    </tr>
                                                    </tfoot>
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

    function deleteCollection(id) {

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
                'Your Collection name is safe :)',
                'error'
                )
            }
        })

    }

    </script>
@endpush


