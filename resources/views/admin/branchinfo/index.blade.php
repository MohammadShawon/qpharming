<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Branch')

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
            <div class="card-body ">
                <div class="row">
                    @foreach ($branches as $branch)
                        <div class="col-md-4">
                            <div class="card card-box">
                                <div class="card-body no-padding ">
                                    <div class="doctor-profile" style="padding: 35px 0px;">
                                            <img src="{{ asset('admin/assets/img/dp.jpg') }}" class="doctor-pic" alt=""> 
                                        <div class="profile-usertitle">
                                            <div class="doctor-name">{{$branch->name}}</div>
                                        </div>
                                            <p>
                                                @foreach ($branch->users as $user)
                                                    @foreach ($user->roles as $userRoles)
                                                        @if ($userRoles->name == 'manager' )
                                                        Manager : <a href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}</a>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </p> 
                                            <p>
                                                Employee : {{ $branch->users()->count() }}
                                            </p> 
                                            <p>
                                                Farmer : {{ $branch->farmers()->count() }}
                                            </p> 
                                            <div>
                                                <p><i class="fa fa-phone"></i>
                                                    @foreach ($branch->users as $user)
                                                        @foreach ($user->roles as $userRoles)
                                                            @if ($userRoles->name == 'manager' )
                                                            <a href="{{ route('admin.user.show', $user->id) }}">{{ $user->phone1 }}</a>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </p> 
                                            </div>
                                        <div class="profile-userbuttons">
                                        <a href="{{ url('particular-branch/'.$branch->id.'/farmers') }}" style="padding: 10px 90px;" class="btn btn-circle deepPink-bgcolor btn-lg">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
    
    function deleteBranch(id) {

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


