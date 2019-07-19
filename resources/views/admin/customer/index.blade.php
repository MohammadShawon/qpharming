@extends('template.app')

@section('title','Customer Lists')

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
                <a href="{{ route('admin.customer.create') }}" id="addRow1" class="btn btn-primary"
                   style="font-size:14px; padding: 6px 12px;">
                    Add New Customer <i style="color:white;" class="fa fa-plus"></i>
                </a>

            </div>

            <div class="card card-topline-red">
                <div class="card-head" style="text-align: center;">

                </div>
                <div class="card-body ">
                    <div class="row p-b-20">
                        <div class="col-md-6 col-sm-6 col-6">

                        </div>
                        <div class="col-md-6 col-sm-6 col-6">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            {!! $dataTable->table(['class' => 'table table-striped table-bordered table-hover table-checkable order-column table-responsive','style' => 'width: 100%','id' => 'example4' ]) !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css') }}">
    <script src="{{ asset('https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>

    <!-- sweet aleart -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


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
                                url: "customer/" + id,
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
                                'Your SubCategory name is safe :)',
                                'error'
                            )
                        }
                    })


                // var yes = confirm("Are you confirm you want to delete!");
                //
                // if(yes)
                // {
                //     $.ajax({
                //         url: "customer/" + id,
                //         type: "POST",
                //         data: { id: id,_method:'delete',_token: _token },
                //         success: function () {
                //             // toastr.success('Success messages');
                //             // location.reload();
                //             toastr.success("Successfully deleted");
                //
                //         },
                //         error: function (msg) {
                //             console.log(msg);
                //         }
                //     });
                // }

            });

        });

    </script>
@endpush
