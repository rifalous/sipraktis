@extends('layouts.master')

@section('title')
	Tambah Sub Kegiatan
@endsection

@section('content')

@php($active = 'sub-activity')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Sub Kegiatan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('sub-activity.index') }}">Sub Kegiatan</a>
                    </li>
                    <li class="active">
                        Tambah Sub Kegiatan
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
                    <form method="post" action="{{ route('sub-activity.store') }}" id="form-add-edit">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Kode Rekening <span class="text-danger">*</span></label>
                                <input type="text" name="kode" class="form-control" placeholder="Kode Rekening" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Sub Kegiatan <span class="text-danger">*</span></label>
                                <textarea name="sub_activity_name" placeholder="Sub Kegiatan" class="form-control" rows="5"></textarea>
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