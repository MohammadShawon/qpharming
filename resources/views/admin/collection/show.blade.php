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

                            <div class="col-md-3 col-6"> <strong>PurposeHead</strong>
                                <br>
                                <p class="text-muted">{{ $collection->purposehead->name }}</p>
                            </div>

                            @if (is_null($collection->farmer_id))
                                <div class="col-md-3 col-6"> <strong>Company</strong>
                                    <br>
                                    <p class="text-muted">
                                        
                                        {{ $collection->company->name }}
                                    
                                    </p>
                                </div>
                            @endif
                            @if (is_null($collection->company_id))
                                <div class="col-md-3 col-6 b-r"> <strong>Farmer</strong>
                                    <br>
                                    <p class="text-muted">
                                        
                                        {{ $collection->farmer->name }}
                                    
                                    </p>
                                </div>
                            @endif

                            <div class="col-md-3 col-6 b-r"> <strong>Collection Amount</strong>
                                <br>
                                <p class="text-muted">{{ $collection->collection_amount }}</p>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            
                            <div class="col-md-3 col-6 b-r"> <strong>Collection Type</strong>
                                <br>
                                <p class="text-muted">{{ $collection->collection_type }}</p>
                            </div>
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
                        {{-- <p class="m-t-30">Completed my graduation in Arts from the well known and renowned institution of India – SARDAR PATEL ARTS COLLEGE, BARODA in 2000-01, which was affiliated to M.S. University. I ranker in University exams from the same university from 1996-01.</p>
                        <p>Worked as  Professor and Head of the department at Sarda Collage, Rajkot, Gujarat from 2003-2015 </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <br> --}}
                        <h4 class="font-bold">Remarks</h4>
                        <hr>
                        <ul>
                            {{ $collection->remarks }}
                        </ul>
                        <br>
                        {{-- <h4 class="font-bold">Experience</h4>
                        <hr>
                        <ul>
                            <li>One year experience as Jr. Professor from April-2009 to march-2010 at B. J. Arts College, Ahmedabad.</li>
                            <li>Three year experience as Jr. Professor at V.S. Arts & Commerse Collage from April - 2008 to April - 2011.</li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                        </ul>
                        <br>
                        <h4 class="font-bold">Conferences, Cources & Workshop Attended</h4>
                        <hr>
                        <ul>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                            <li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </li>
                        </ul> --}}
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


