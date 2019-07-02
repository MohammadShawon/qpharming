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
                                          <div class="panel panel-default">
                                              <div class="panel-heading panel-heading-gray">
                                                  <h4 class="panel-title">
                                                      <a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1">
                                                          Batch Name : July 2019 <span aria-hidden="true" class="icon-arrow-right "></span>
                                                          Batch ID : J1906 <span aria-hidden="true" class="icon-arrow-right "></span>
                                                          Status : <span class="label label-sm label-primary">Running</span>
                                                      </a>
                                                  </h4>
                                              </div>
                                              <div id="collapse_3_1" class="panel-collapse collapse">
                                                <br>
                                                <div>
                                                    <ol class="breadcrumb page-breadcrumb">
                                                        <div>
                                                        <li><span class="parent-item"> Project No</span> : 
                                                            <b>J1906 </b>
                                                            <span class="parent-item"> Chicken Amount</span> : 
                                                            <b>120</b>
                                                            <span class="parent-item"> Supervisor</span> : 
                                                            <b>Md. Nurullah</b>
                                                        </li>
                                                    </div>
                                                </ol>
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
                                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal">
                                          Add Record
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Input Record</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label for="age"> Age</label>
                                                            <input type="number" class="form-control" id="age">
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label for="died"> Died</label>
                                                            <input type="number" class="form-control" id="died">
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label for="feed_kg"> Feed - kg</label>
                                                            <input type="number" class="form-control" id="feed_kg">
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label for="feed_sack"> Feed - Sack</label>
                                                            <input type="number" class="form-control" id="feed_sack">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label for="feed_left"> Feed Left</label>
                                                            <input type="number" class="form-control" id="feed_left">
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                                            <label for="weight"> Wieght</label>
                                                            <input type="number" class="form-control" id="weight">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-3">
                                                            <label for="sickness"> Sickness</label>
                                                            <input type="text" id="sickness" class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <label for="comment"> Comments</label>
                                                            <input type="text" class="form-control" id="comment">
                                                        </div>
                                                    </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary add-row" data-dismiss="modal">Save</button>
                                              </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="panel panel-default">
                                              <div class="panel-heading panel-heading-gray">
                                                  <h4 class="panel-title">
                                                      <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2">
                                                          Batch Name : June 2019 <span aria-hidden="true" class="icon-arrow-right "></span>
                                                          Batch ID : J1905 <span aria-hidden="true" class="icon-arrow-right "></span>
                                                          Status : <span class="label label-sm label-danger">Completed</span>
                                                      </a>
                                                  </h4>
                                              </div>
                                              <div id="collapse_3_2" class="panel-collapse collapse">
                                                  <div class="panel-body" style="height:200px; overflow-y:auto;">
                                                      <p>....</p>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="panel panel-default">
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
                                          </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@push('js')

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