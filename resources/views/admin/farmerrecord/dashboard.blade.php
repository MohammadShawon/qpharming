<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Farmer Record Dashboard')

@push('css')
    <!-- data tables -->
    <link href="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css')}} " rel="stylesheet" type="text/css"/>

@endpush

@section('content')
    <div class="col-md-12">
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
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="panel">
                                <header class="panel-heading panel-heading-blue text-center">
                                    Age
                                </header>
                                <div class="panel-body text-center">
                                    <b>18 Days</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="panel">
                                <header class="panel-heading panel-heading-blue text-center">
                                    Total Died
                                </header>
                                <div class="panel-body text-center">
                                    <b>18</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="panel">
                                <header class="panel-heading panel-heading-blue text-center">
                                    Total Feed
                                </header>
                                <div class="panel-body text-center">
                                    <b>120 kg</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="panel">
                                <header class="panel-heading panel-heading-blue text-center">
                                    Total Feed
                                </header>
                                <div class="panel-body text-center">
                                    <b>2.2 Sack</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="panel">
                                <header class="panel-heading panel-heading-blue text-center">
                                    Feed Left
                                </header>
                                <div class="panel-body text-center">
                                    <b>4.3 Sack</b>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="panel">
                                <header class="panel-heading panel-heading-blue text-center">
                                    Weigh Per Pics
                                </header>
                                <div class="panel-body text-center">
                                    <b>400 gm</b> (Now)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6">
                            <br><br>
                            <a href="{{ route('admin.farmer-records.create') }}" class="btn btn-danger btn-lg m-b-10">
                                Add Todays Record
                            </a>
                            <a href="{{ route('admin.farmer-records.index') }}" class="btn btn-success btn-lg m-b-10">
                                View Full Record
                            </a>
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