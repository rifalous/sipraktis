@extends('layouts.master')

@section('title')
	Tambah Rincian Belanja
@endsection

@section('content')

@php($active = 'rincian')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah Rincian Belanja</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li>
                        <a href="{{ route('rincian.index') }}">Rincian Belanja</a>
                    </li>
                    <li class="active">
                        Tambah Rincian Belanja
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
                    <form method="post" action="{{ route('rincian.store') }}" id="form-add-edit">
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
                                <label class="control-label">Rincian Belanja <span class="text-danger">*</span></label>
                                <textarea name="rincian_name" placeholder="Rincian Belanja" class="form-control" rows="5"></textarea>
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