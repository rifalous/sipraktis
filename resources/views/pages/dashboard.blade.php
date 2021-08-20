@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('content')

@php($active = 'dashboard')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li class="active">
                        Dashboard
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-warning">
                <i class="mdi mdi-account widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User">User</p>
                    <h2><span data-plugin="counterup">{{ count($users) }}</span> <small></small></h2>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 40.33k</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-primary">
                <i class="fa fa-desktop widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Program">Program</p>
                    <h2><span data-plugin="counterup">{{ count($programs) }}</span> <small></small></h1>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 30.4k</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-danger">
                <i class="fa fa-shopping-bag widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Kegiatan">Kegiatan</p>
                    <h2><span data-plugin="counterup">{{ count($activities) }}</span> <small></small></h2>
                    <!-- <p class="text-muted m-0"><b>Last:</b> 30.4k</p> -->
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-6">
            <div class="card-box widget-box-two widget-two-success">
                <i class="mdi mdi-account-convert widget-two-icon"></i>
                <div class="wigdet-two-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Sub Kegiatan">Sub Kegiatan</p>
                    <h2><span data-plugin="counterup">{{ count($sub_activities) }}</span> <small></small></h2>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
</div> <!-- container -->

@endsection

@push('js')
@if (session()->has('message'))
    <script type="text/javascript">
        show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
    </script>
@endif
<script src="{{ url('assets/js/pages/dashboard.js') }}"></script>
@endpush
