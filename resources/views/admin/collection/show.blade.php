<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Collection - Details')

@push('css')
@endpush

@section('content')

    <div class="btn-group">
        <a style="color:white; font-size:15px; padding: 3px 7px 5px 0;" href="{{ route('admin.collection.index') }}" id="addRow1" class="btn deepPink-bgcolor">
            <i style="color:white; font-size:12px; padding: 3px;" class="fa fa-arrow-left"></i>BACK
        </a>
    </div>
    <div class="card">
        <div class="card-topline-aqua">
            <header></header>
        </div>
        <div class="white-box">
            <!-- Nav tabs -->
            <div class="p-rl-20">
                <ul class="nav customtab nav-tabs" role="tablist">
                    <li class="nav-item"><a href="#tab1" class="nav-link active"  data-toggle="tab" >Collection Details</a></li>
                </ul>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div id="biography" >
                        <div class="row">
                            <div class="col-md-3 col-6 b-r"> <strong>Bank Name</strong>
                                <br>
                                <p class="text-muted">{{ $collection->bank->bank_name }}</p>
                            </div>



                            @if ($collection->collect_type == 'farmer')
                                <div class="col-md-3 col-6"> <strong>Famer</strong>
                                    <br>
                                    <p class="text-muted">

                                        {{ $collection->farmer->name }}

                                    </p>
                                </div>
                            @endif
                            @if (is_null($collection->farmer_id))
                                <div class="col-md-3 col-6 b-r"> <strong>Hen / Egg</strong>
                                    <br>
                                    <p class="text-muted">

                                        {{ ucwords($collection->collect_type) }}

                                    </p>
                                </div>
                            @endif

                            <div class="col-md-3 col-6 b-r"> <strong>Collection Amount</strong>
                                <br>
                                <p class="text-muted">{{ $collection->collection_amount }}</p>
                            </div>


                            <div class="col-md-3 col-6 b-r"> <strong>Collection Type</strong>
                                <br>
                                <p class="text-muted">{{ $collection->collection_type }}</p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">


                            <div class="col-md-3 col-6 b-r"> <strong>Bank Name</strong>
                                <br>
                                <p class="text-muted">{{ $collection->bank_name }}</p>
                            </div>
                            <div class="col-md-3 col-6 b-r"> <strong>Given By</strong>
                                <br>
                                <p class="text-muted">{{ $collection->given_by }}</p>
                            </div>
                            <div class="col-md-3 col-6 b-r"> <strong>Collection Date</strong>
                                <br>
                                <p class="text-muted">{{ $collection->collection_date }}</p>
                            </div>

                        </div>

                        <hr>

                        <h4 class="font-bold">Remarks</h4>
                        <hr>
                        <ul>
                            {{ $collection->remarks }}
                        </ul>
                        <br>

                        <br>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

@endsection

@push('js')

@endpush


