<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Notifications')

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
            <div class="card card-topline-red">
                <div class="card-head">
                    <header>ALL - NOTIFICATION's </header>
                    <div class="tools">
                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                        <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                        <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example4">
                        <tbody>

                            @foreach (Auth::user()->notifications as $notification)
                                    <tr class="odd gradeX">
                                    <td class="text-left">
                                        @if($notification->type == 'App\Notifications\FarmerCreateNotification')
                                        
                                        <a href="/{{ $notification->data['route'] }}" class="text-success">
                                                
                                                <span><mark>{{ $notification->data['farmer_name'] }}</mark></span> registered as a farmer in {{ $notification->data['branch_name'] }}
                                            </a>
                                            <span> --  {{ str_replace(['minutes', 'minute', 'second', 'seconds'], ['mins', 'min', 'sec', 'secs'], $notification->created_at->diffForHumans()) }}
                                            </span>
                                        @endif
                                        @if($notification->type == 'App\Notifications\UserCreateNotification')
                                        
                                        <a href="/{{ $notification->data['route'] }}" class="text-success">
                                                
                                                <span><mark>{{ $notification->data['user_name'] }}</mark></span> registered as a user
                                            </a>
                                            <span> --
                                                    {{ str_replace(['minutes', 'minute', 'second', 'seconds'], ['mins', 'min', 'sec', 'secs'], $notification->created_at->diffForHumans()) }}
                                                </span>
                                        @endif
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
    
    function deleteTag(id) {

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
                'Your Area name is safe :)',
                'error'
                )
            }
        })

    }
    
    </script>
@endpush