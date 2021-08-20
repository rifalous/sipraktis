@extends('layouts.master')

@section('title')
	Ubah Jabatan
@endsection

@section('content')

@php($active = 'position')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Ubah Jabatan</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('position.index') }}">Jabatan</a>
                    </li>
                    <li class="active">
                        Ubah Golongan
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
                    <form method="post" action="{{ route('position.update', $position->id) }}" id="form-add-edit">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="position_name" class="form-control" placeholder="Jabatan" required="required" value="{{ $position->position_name }}">
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-12 text-right">
                            <hr>

                            <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>

                            <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>

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