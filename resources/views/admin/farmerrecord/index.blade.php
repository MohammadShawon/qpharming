<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Farmer Daily Report')

@push('css')
    <!-- data tables -->
    <link href="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}} " rel="stylesheet" type="text/css"/>

@endpush

@section('content')
    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <ol class="breadcrumb page-breadcrumb pull-left">
                                <div>
                                    <li><span class="parent-item">Farmer Name</span> : 
                                        <b>Md. Based Mullah</b>
                                    </li>
                                </div>
                                <div>
                                    <li><span class="parent-item">Address</span> : 
                                        <b>Fulbadia, Mymensingh</b>
                                    </li>
                                </div>
                                <div>
                                    <li><span class="parent-item">Mobile</span> : 
                                        <b>019 123 45678</b>
                                    </li>
                                </div>
                            </ol>
                            <ol class="breadcrumb page-breadcrumb float-lg-right">
                                <div>
                                    <li><span class="parent-item">Project No</span> : 
                                        <b>76</b>
                                    </li>
                                </div>
                                <div>
                                    <li><span class="parent-item">Chicken Amount</span> : 
                                        <b>120</b>
                                    </li>
                                </div>
                                <div>
                                    <li><span class="parent-item">Supervisor</span> : 
                                        <b>Md. Nurullah</b>
                                    </li>
                                </div>
                            </ol>
                        </div>
                    </div>
     <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header><b>Md. Based Mullah</b> -  Daily Records</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                  <div class="table-scrollable">
                                    <table id="example1" class="display" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>Age</th>
                                                <th>Died</th>
                                                <th>Feed Eaten - kg</th>
                                                <th>Feed Eaten - Sack</th>
                                                <th>Feed left</th>
                                                <th>Wieght</th>
                                                <th>Sickness</th>
                                                <th>Comments</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>10</th>
                                                <th>20</th>
                                                <th>210 kg</th>
                                                <th>2.5 Sack</th>
                                                <th>0.5 Sack</th>
                                                <th>1500gm</th>
                                                <th>No</th>
                                                <th>Ready For Sale</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td>Well</td>
                                                <td>Garrett Winters Garrett Winters Garrett Winters</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td>Well</td>
                                                <td>Garrett Winters Garrett Winters Garrett Winters</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td>Well</td>
                                                <td>Garrett Winters Garrett Winters Garrett Winters</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td>Well</td>
                                                <td>Garrett Winters Garrett Winters Garrett Winters</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td>Well</td>
                                                <td>Garrett Winters Garrett Winters Garrett Winters</td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td>Well</td>
                                                <td>Garrett Winters Garrett Winters Garrett Winters</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
    
    function deleteCategory(id) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Related \'Sub-Category\' will also be deleted!",
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
                'Your Category name is safe :)',
                'error'
                )
            }
        })

    }
    
    </script>
@endpush


