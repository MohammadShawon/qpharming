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
    <div class="row">
        <div class="col-sm-12">
            <div class="panel ">
                <div class="panel-body">
                    
                    <div class="row">
                        
                        
                        <div class="col-md-6">
                            <div>
                                <span class="parent-item">Farmer Name</span> : <b>{{ $farmer->name }}</b>
                            </div>
                            <div>
                                <span class="parent-item">Address</span> : <b>{{ $farmer->address}}</b>
                            </div>
                            <div>
                                <span class="parent-item">Mobile</span> : <b>{{ $farmer->phone1 }}</b>
                            </div>
                        </div>
                        
                        <div class="col-md-6 ">
                            <a href="{{ url('/farmer/'.$farmer->id.'/batch/create') }}"  class="btn btn-success btn-lg m-b-10 pull-right">
                                Add New Batch
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
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
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="card">
            <div class="card-head">
                <header>DAILY RECORDS</header>
            </div>
            <div class="card-body" id="line-parent">
                <div class="panel-group accordion" id="accordion3">
                    @foreach ($farmer->farmerbatches as $farmerBatch)
                        <div class="panel panel-default">
                            <div class="panel-heading panel-heading-gray active">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#{{$farmerBatch->batch_number}}">
                                        Batch Name : {{ $farmerBatch->batch_name }} <span aria-hidden="true" class="icon-arrow-right "></span>
                                        Batch Number : {{ $farmerBatch->batch_number }} <span aria-hidden="true" class="icon-arrow-right "></span>
                                        Status : <span class="label label-sm label-success">{{ $farmerBatch->status }}</span>
                                    </a>
                                    <span class="pull-right">
                                        <a class="text-primary" href="{{ url('/farmer/'.$farmer->id.'/batch/'.$farmerBatch->id.'/edit') }}">Edit</a> | 
                                        <a class="text-danger" onclick="deleteFarmerBatch({{$farmerBatch->id}})" href="#">Delete</a>

                                        <form id="delete-form-{{$farmerBatch->id}}" action="{{ url('/farmer/'.$farmer->id.'/batch/'.$farmerBatch->id) }}" method="post" style="display:none;">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </span>
                                    
                                </h4>
                            </div>
                            <div id="{{$farmerBatch->batch_number}}" class="panel-collapse {{ $farmerBatch->status == 'active' ? 'in': 'collapse' }}">
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-sm-6">
                                        <a data-toggle="modal" data-target="#farmerRecordForm" class="btn btn-danger btn-lg m-b-10">
                                            Add Todays Record
                                        </a>
                                        <a href="" class="btn btn-success btn-lg m-b-10">
                                            View Full Record
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="text-center">
                                            <tr>
                                                <th></th>
                                                <th>
                                                    Age
                                                    <p class="text-success"><b>18</b></p>
                                                </th>
                                                <th>
                                                    Died
                                                    <p class="text-success"><b>7</b></p>
                                                </th>
                                                <th>
                                                    Feed Eaten - kg
                                                    <p class="text-success"><b>56 kg</b></p>
                                                </th>
                                                <th>
                                                    Feed Eaten - Sack
                                                    <p class="text-success"><b>5 Sack</b></p>
                                                </th>
                                                <th>
                                                    Feed left
                                                    <p class="text-success"><b>4.5 Sack</b></p>
                                                </th>
                                                <th>
                                                    Wieght
                                                    <p class="text-success"><b>450gm</b></p>
                                                </th>
                                                <th>Sickness</th>
                                                <th>Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td><input type='checkbox' name='record'></td>
                                                <td>1</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td style="max-width: 150px;">Well</td>
                                                <td style="max-width: 250px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad iure nesciunt eaque reprehenderit a.</td>
                                            </tr>
                                            <tr class="text-center">
                                                <td><input type='checkbox' name='record'></td>
                                                <td>2</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td style="max-width: 150px;">Well</td>
                                                <td style="max-width: 250px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad iure nesciunt eaque reprehenderit a.</td>
                                            </tr>
                                            <tr class="text-center">
                                                <td><input type='checkbox' name='record'></td>
                                                <td>3</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td style="max-width: 150px;">Well</td>
                                                <td style="max-width: 250px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad iure nesciunt eaque reprehenderit a.</td>
                                            </tr>
                                            <tr class="text-center">
                                                <td><input type='checkbox' name='record'></td>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>20 kg</td>
                                                <td>0.01 Sack</td>
                                                <td>20.01 Sack</td>
                                                <td>100gm</td>
                                                <td style="max-width: 150px;">Well</td>
                                                <td style="max-width: 250px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad iure nesciunt eaque reprehenderit a.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger delete-row">
                                        Delete
                                    </button>
                                    {{-- Daily Record Modal Form --}}
                                    @include('admin.modals.farmers.daily-record')
                                    
                                    {{-- Daily Record Modal form ends --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- <div class="panel panel-default">
                        <div class="panel-heading panel-heading-gray">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3">
                                    Batch Name : May 2019 <span aria-hidden="true" class="icon-arrow-right "></span>
                                    Batch ID : M1904 <span aria-hidden="true" class="icon-arrow-right "></span>
                                    Status : <span class="label label-sm label-danger">Completed</span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>....</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@csrf
{{-- 
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
    </div> --}}
    @endsection
    
    @push('js')
    
    
    <!-- data tables -->
    <script src="{{ asset('admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js') }}" ></script>
    <script src="{{ asset('admin/assets/js/pages/table/table_data.js') }}" ></script>
    
     <!-- sweet aleart -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

     <script type="text/javascript">
     
     function deleteFarmerBatch(id) {
 
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
                 'Your Farmer Batch is safe :)',
                 'error'
                 )
             }
         })
 
     }
     
     </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $(".add-row").click(function(){
                var age = $("#age").val();
                var died = $("#died").val();
                var feed_kg = $("#feed_kg").val();
                var feed_sack = $("#feed_sack").val();
                var feed_left = $("#feed_left").val();
                var weight = $("#weight").val();
                var sickness = $("#sickness").val();
                var comment = $("#comment").val();
                var markup = "<tr class='text-center'><td><input type='checkbox' name='record'></td><td>" + age+ "</td><td>" + died+ "</td><td>" + feed_kg+ "</td><td>" + feed_sack+ "</td><td>" + feed_left + "</td><td>" + weight+ "</td><td style='max-width: 150px;'>" + sickness+ "</td><td style='max-width: 250px;'>" + comment+ "</td></tr>";
                $("table tbody").append(markup);
            });
            
            // Find and remove selected table rows
            $(".delete-row").click(function(){
                $("table tbody").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("tr").remove();
                    }
                });
            });
        });    
    </script>
    
    {{-- Record Form Js --}}
    <script src="{{ asset('js/daily-record-form.js') }}"></script>
    @endpush