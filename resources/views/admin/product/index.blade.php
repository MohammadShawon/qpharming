<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Product')

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
                <a href="{{ route('admin.product.create') }}" id="addRow1" class="btn btn-primary"
                style="font-size:14px; padding: 6px 12px;" >
                    Add New Product <i style="color:white;" class="fa fa-plus"></i>
                </a>
                
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
                <div class="card-head" style="text-align: center;">
                    <header>PRODUCT</header><span class="btn btn-primary ml-3"> {{ $products->count() }} </span>
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
                                <th> Serial </th>
                                <th> Name </th>
                                <th> Category </th>
                                <th> Sub Category </th>
                                <th> Size </th>
                                <th> Quantity </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key=>$product)
                                <tr class="odd gradeX">
                                    <td> {{ $key+1 }} </td>
                                    <td>{{ $product->product_name }}</td>
                                    
                                    <td>{{ $product->subcategory->category->name }}</td>
                                    <td>{{ $product->subcategory->name }}</td>
                                    <td>{{ $product->size }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    
                                    <td>
                                        <a  class="waves-effect btn btn-success" href="{{ route('admin.product.show', $product->id) }}"><i class="material-icons">visibility</i></a>
                                        
                                        <a  class="waves-effect btn btn-primary" href="{{ route('admin.product.edit', $product->id) }}"><i class="material-icons">edit</i></a>
                                        
                                        <button type="submit" class="waves-effect btn deepPink-bgcolor"
                                        onclick="deleteProduct({{$product->id}})">
                                        <i class="material-icons">delete</i>
                                        </button>
    
                                        <form id="delete-form-{{$product->id}}" action="{{ route('admin.product.destroy', $product->id) }}" method="post" style="display:none;">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> Serial </th>
                                <th> Name </th>
                                <th> Category </th>
                                <th> Sub Category </th>
                                <th> Size </th>
                                <th> Quantity </th>
                                <th> Action </th>
                            </tr>
                        </tfoot>
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
    
    function deleteProduct(id) {

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
                'Your Product name is safe :)',
                'error'
                )
            }
        })

    }
    
    </script>
@endpush


