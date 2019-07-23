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
<div class="row justify-content-center">
    <div class="col-md-3 justify-content-center">
        <div class="card">
            <div class="card-body no-padding height-9">
                
                <div class="profile-userpic">
                    <img src="{{ asset('admin/assets/img/farmer.jpg') }}" class="img-responsive" alt="">
                </div>
            </div>
        </div>
        <a href="{{ url('/farmer/'.$farmer->id.'/batch/create') }}" class="btn btn-primary btn-lg btn-block">Add New Branch</a>
        <a class="btn btn-danger btn-lg btn-block">Something New</a>
    </div>
    <div class="col-md-6 justify-content-center">
        <div class="row justify-content-center">
            <h1 style="font-weight: 900"><b>Forazi Agro Ltd.</b></h1>
        </div>
        <div class="card">
            <div class="card-body no-padding height-9">
                
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> Farmer Profile </div>
                </div>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>ID</b> <a class="pull-right">{{ $farmer->id}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Name</b> <a class="pull-right">{{ $farmer->name }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Address</b> <a class="pull-right">{{ $farmer->address}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Total Cost</b> <a class="pull-right">25,000</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 justify-content-center">
        <div class="card">
            <div class="card-body no-padding height-9">
                
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"><span class="btn btn-circle btn-success">Round 2</span></div>
                </div>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Opening Date</b> <a class="pull-right">20 July, 19</a>
                    </li>
                    <li class="list-group-item">
                        <b>Running Date</b> <a class="pull-right">20 July, 19</a>
                    </li>
                </ul>
            </div>
        </div>
                <a class="btn btn-primary btn-lg btn-block">Add Today Report</a>
                <a class="btn btn-danger btn-lg btn-block">View Daily Report</a>
    </div>
    <div class="col-md-12">
        <div class="card">
        <div class="card-body " style="">
            <div class="table-scrollable">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Feed and Medicin</th>
                            <th>Quantity</th>
                            <th>Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>22 July, 19</td>
                            <td>Name of Feed or Medicine</td>
                            <td>2</td>
                            <td>450</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>23 July, 19</td>
                            <td>Name of Feed or Medicine</td>
                            <td>12</td>
                            <td>8000</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>24 July, 19</td>
                            <td>Name of Feed or Medicine</td>
                            <td>4</td>
                            <td>750</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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