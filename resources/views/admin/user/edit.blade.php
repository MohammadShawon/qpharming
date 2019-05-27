<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Update - User')

@push('css')
   <!--select2-->
   <link href="{{ asset('admin/assets/plugins/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('admin/assets/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
   
   <link href="{{ asset('admin/assets/css/password-hide/example.wink.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')
    <div class="page-bar">
        <div class="page-title-breadcrumb">
            
        </div>
    </div>
    <div class="row ">
        <div class="col-md-12 col-sm-12">
            <div class="card card-box">
                <div class="card-head text-white " style="background-color:#3FCC7E;">
                    <header>Update USER</header>
                </div>
                <div class="card-body" id="bar-parent">
                    <form method="post" action="{{ route('admin.user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="simpleFormEmail">Name</label>
                                    <input type="text" name="user" class="form-control" id="simpleFormEmail" placeholder="Enter User's name" value="{{ $user->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Select Branch</label>
                                    <select name="branch" class="form-control  select2 " >
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}"
                                                {{ $branch->id == $user->branch_id ? 'selected':''}}
                                                >{{ $branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Select Role</label>
                                    <select name="roles[]" class="form-control select2 " multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                @foreach ($user->roles as $userRoles)
                                                    {{ $role->id == $userRoles->id ? 'selected':'' }}
                                                @endforeach
                                                >
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Username</label>
                                    <input type="text" name="username" class="form-control" id="simpleFormEmail" placeholder="Enter Username" value="{{ $user->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Update Password</label>
                                    <input id="password-1" type="password" name="password" class="form-control" id="simpleFormEmail" placeholder="Enter password" >
                                </div>
                            </div>

                        
                            <div class="col-md-6 col-sm-6">

                                <div class="form-group">
                                    <label for="simpleFormEmail">Phone</label>
                                    <input type="text" name="phone1" class="form-control" id="simpleFormEmail" placeholder="Enter User phone number" value="{{ $user->phone1 }}">
                                </div>

                                <div class="form-group">
                                    <label for="simpleFormEmail">Alternative Phone</label>
                                    <input type="text" name="phone2" class="form-control" id="simpleFormEmail" placeholder="Enter alternaive phone" value="{{ $user->phone2 }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Email</label>
                                    <input type="email" name="email" class="form-control" id="simpleFormEmail" placeholder="Enter User email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Address</label> 
                                    <textarea name="address" id="simpleFormEmail" class="form-control">{{ $user->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="simpleFormEmail">Status</label>
                                    <input type="text" name="status" class="form-control" id="simpleFormEmail" placeholder="Enter farmer status" value="{{ $user->status }}">
                                </div>

                                
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="">Ending Date</label>
                            <div class="input-group date form_datetime" data-date="{{ Carbon::now() }}" data-date-format="dd MM yyyy  HH:ii p" data-link-field="dtp_input1">
                                <input class="form-control" size="16" type="text" name="ending_date" value="{{ old('ending_date') }}">
                                <span class="input-group-addon ml-2">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <input type="hidden" id="dtp_input1" value="" />
                        </div> --}}

                       
                        
                        <a class="btn deepPink-bgcolor m-t-15 waves-effect" href="{{ route('admin.user.index') }}">BACK</a>
                        <button type="submit" class="btn btn-success m-t-15 waves-effect">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!--select2-->
    <script src="{{ asset('admin/assets/plugins/select2/js/select2.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/select2/select2-init.js') }}" ></script>

    <!-- including the plugin -->
    <script src="{{asset('admin/assets/js/password-hide/hideShowPassword.min.js')}}"></script>


    <script>
        $('#password-1').hidePassword(true);
    </script>

   
   
@endpush
