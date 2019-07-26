<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Company')

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
                    <a href="{{ route('admin.company.create') }}" id="addRow1" class="btn btn-primary" style="font-size:14px; padding: 6px 12px;">
                        Add New Company <i style="color:white;" class="fa fa-plus"></i>
                    </a>
                    
                </div>

            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">
                    <header>COMPANY</header> <span class="btn btn-primary ml-3"> {{ DB::table('companies')->count() }} </span>

                </div>
                <div class="card-body ">
                    <div class="row p-b-20">
                        <div class="col-md-6 col-sm-6 col-6">
                            
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            
                        </div>
                    </div>
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- data tables -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js') }}"></script>
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
                var url = "{{route('admin.company.destroy',':id')}}";
                url = url.replace(':id', id);


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
                            url:url ,
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
                            'Your Company name is safe :)',
                            'error'
                        )
                    }
                })


            });

        });

    </script>
@endpush


