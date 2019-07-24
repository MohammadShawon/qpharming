<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Sub - Category')

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
                <a href="{{ route('admin.sub-category.create') }}" id="addRow1" class="btn btn-primary" style="font-size:14px; padding: 6px 12px;" >
                    Add New Sub-Category <i style="color:white;" class="fa fa-plus"></i>
                </a>
                
            </div>

            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    {{-- <header>SUB-CATEGORY</header><span class="btn btn-primary ml-1"> {{ $subcategories->count() }} </span> --}}
                    <header>
                        Sub Category Lists
                    </header>
                </div>
                <div class="card-body ">

                    
                    {!! $dataTable->table() !!}
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>

    <script src="{{ asset('admin/assets/js/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}


    <!-- sweet aleart -->
    <script src="{{ asset('admin/assets/js/sweetalert.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            //region delete
            $(document).on("click","button.delete",function (e) {
                var id = $(this).data('value');

                var _token = '{{ csrf_token() }}';


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
                        // id.submit();
                        $.ajax({
                            url: "sub-category/" + id,
                            type: "POST",
                            data: { id: id,_method:'delete',_token: _token },
                            success: function () {
                                // toastr.success('Success messages');
                                location.reload();
                                // toastr.success("Successfully deleted");

                            },
                            error: function (msg) {
                                console.log(msg);
                            }
                        });
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your Sub Category name is safe :)',
                            'error'
                        )
                    }
                })




            });

        });

    </script>
@endpush


