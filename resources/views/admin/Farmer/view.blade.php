<?php
    use Carbon\Carbon;
?>
@extends('template.app')

@section('title', 'Farmer')

@push('css')
@endpush

@section('content')

    <div class="btn-group">
        <a style="color:white; font-size:15px; padding: 3px 7px 5px 0;" href="{{ route('admin.farmer.index') }}" id="addRow1" class="btn deepPink-bgcolor">
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
                    <li class="nav-item"><a href="#tab1" class="nav-link active"  data-toggle="tab" >Farmer Details</a></li>
                </ul>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active fontawesome-demo" id="tab1">
                    <div id="biography" >
                        <div class="row">
                            <div class="col-md-3 col-6 b-r"> <strong>Full Name</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->name }}</p>
                            </div>
                            {{-- <div class="col-md-3 col-6 b-r"> <strong>Username</strong>
                                <br>
                                <p class="text-muted">{{ $user->username }}</p>
                            </div> --}}
                            
                            <div class="col-md-3 col-6"> <strong>Branch</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->branch->name }}</p>
                            </div>
                            <div class="col-md-3 col-6"> <strong>Opening Balance</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->opening_balance }}</p>
                            </div>
                            <div class="col-md-3 col-6 b-r"> <strong>Email</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 col-6 b-r"> <strong>Phone</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->phone1 }}</p>
                            </div>
                            <div class="col-md-3 col-6 b-r"> <strong>Alternative Phone</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->phone2 }}</p>
                            </div>
                            <div class="col-md-3 col-6 b-r"> <strong>Starting Date</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->created_at->toDayDateTimeString() }}</p>
                            </div>
                            <div class="col-md-3 col-6 b-r"> <strong>Status</strong>
                                <br>
                                <p class="text-muted">{{ $farmer->status }}</p>
                            </div>
                            
                        </div>
                        <hr>
                        {{-- <p class="m-t-30">Completed my graduation in Arts from the well known and renowned institution of India – SARDAR PATEL ARTS COLLEGE, BARODA in 2000-01, which was affiliated to M.S. University. I ranker in University exams from the same university from 1996-01.</p>
                        <p>Worked as  Professor and Head of the department at Sarda Collage, Rajkot, Gujarat from 2003-2015 </p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <br> --}}
                        <h4 class="font-bold">Address</h4>
                        <hr>
                        <ul>
                            {{ $farmer->address }}
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


