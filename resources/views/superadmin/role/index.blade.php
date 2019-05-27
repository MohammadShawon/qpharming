<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Role')

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
                     <a href="{{ route('super-admin.role.create')}}" id="addRow1" class="btn btn-primary">
                        Add New <i style="color:white;" class="fa fa-plus"></i>
                    </a>
                    <span class="btn btn-primary ml-3"> {{ $roles->count() }} </span>
                </div>
                <div class="btn-group pull-right">
                        <button class="btn deepPink-bgcolor  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-print"></i> Print </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                            </li>
                        </ul>
                    </div>
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>ALL - ROLE's </header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="row p-b-20">
                        <div class="col-md-6 col-sm-6 col-6">
                            
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" style="width: 100%" id="example4">
                        <thead>
                            <tr>
                                
                                <th> Serila </th>
                                <th> Name </th>
                                
                                <th> Permissions </th>
                                {{-- <th> Created </th> --}}
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $key=>$role)
                                <tr class="odd gradeX">
                                    <td> {{ $key+1 }} </td>
                                    <td>{{ $role->name }}</td>
                                    
                                    <td>
                                        @foreach ($role->permissions as $rolePermission)
                                        <span class="btn" style="background-color: #3fcc7e; color:#fff; padding: 0px 2px 2px 0"> {{ $rolePermission->name }} </span>  
                                        @endforeach
                                    </td>
                                    {{-- <td>{{ $role->created_at->toDayDateTimeString() }}</td> --}}
                                    <td>
                                        <a style="margin-bottom: 4px;"  class="waves-effect  btn btn-primary" href="{{ route('super-admin.role.edit', $role->id) }}"><i class="material-icons">edit</i></a>
                                        
                                        <button type="submit" class="waves-effect btn deepPink-bgcolor"
                                        onclick="deleteRole({{$role->id}})">
                                        <i class="material-icons">delete</i>
                                        </button>
    
                                        <form id="delete-form-{{$role->id}}" action="{{ route('super-admin.role.destroy', $role->id) }}" method="post" style="display:none;">
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
@endsection

@push('js')
    <!-- data tables -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/table/table_data.js') }}" ></script>

    <!-- sweet aleart -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
    
    function deleteRole(id) {

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
                'Your Role name is safe :)',
                'error'
                )
            }
        })

    }
    
    </script>
@endpush


