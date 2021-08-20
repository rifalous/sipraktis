@extends('layouts.master')

@section('title')
    Laporan Rekap Data Rencana Kerja Anggaran
@endsection

@section('content')

@php($active = 'report')

<div class="container">
  <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
        <h4 class="page-title">Laporan Rekap Data Rencana Kerja Anggaran</h4>
        <ol class="breadcrumb p-0 m-0">
          <li class="active">
            Rekap Rencana Kerja Anggaran
          </li>
        </ol>
        <div class="clearfix"></div>
      </div>
		</div>
  </div>
</div>
<!-- End Container -->

<div class="row">
  <div class="col-xs-12">
    <div class="card-box">
      <div class="row m-b-30">
        <form target="_blank" action="{{ url('report/cetak') }}" method="post">
          @csrf

          <div class="form-group">
            <div class="col-md-6">
              <select name="program_id" id="program_id" class="select2" data-placeholder="Global" data-allow-clear="true">
                <option></option>
                @foreach ($programs as $program)
                  <option value="{{ $program['id'] }}">{{ $program['program_name'] }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-1">
              <button type="submit" name="submit" value="pdf" class="btn btn-primary btn-bordered waves-effect waves-light"><i class="mdi mdi-file-pdf"></i> Eksport PDF</button>
            </div>
          </div>
          <div class="form-group" >
            <div class="col-md-1">
              <!-- <button style="margin-left:10px" type="submit" class="btn btn-success btn-bordered waves-effect waves-light">Eksport Excel</button> -->
              <button type="submit" name="submit" value="excel" style="margin-left:40px" class="btn btn-success btn-bordered waves-effect waves-light"><i class="mdi mdi-file-excel"></i> Eksport Excel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')

@if (session()->has('message'))
    <script type="text/javascript">
        show_notification("{{ session('title') }}","{{ session('type') }}","{{ session('message') }}");
    </script>
@endif

@endpush