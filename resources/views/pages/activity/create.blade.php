@extends('layouts.master')

@section('title')
	Tambah Kegiatan
@endsection

@section('content')

@php($active = 'activity')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Kegiatan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('activity.index') }}">Kegiatan</a>
                    </li>
                    <li class="active">
                        Tambah Kegiatan
                    </li>
                </ol>
                <div class="clearfix"></div>
            </div>
		</div>
	</div>
    <!-- end row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">
                <div class="row">
                    <form method="post" action="{{ route('activity.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kode Rekening <span class="text-danger">*</span></label>
                                <input type="text" name="kode" class="form-control" placeholder="Kode" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" name="activity_name" class="form-control" placeholder="Kegiatan" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script src="{{ url('assets/js/pages/position-add-edit.js') }}"></script>
@endpush