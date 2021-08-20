@extends('layouts.master')
@section('title')
	Ubah Server
@endsection

@section('content')

@php($active = 'settings/servers')
	
	<div class="container">

        <div class="row">
			<div class="col-xs-12">
				<div class="page-title-box">
                    <h4 class="page-title">Ubah Server</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="{{ route('servers.index') }}">Server</a>
                        </li>
                        <li class="active">
                            Ubah Server
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
        <!-- end row -->


        <form action="{{ route('servers.update', $server->id) }}" method="post" id="form-add-edit">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Server<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Nama Server" required="required" value="{{ $server->display_name }}">
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Logo / Gambar<span class="text-danger">*</span></label>
                                <input type="text" name="image" class="form-control" placeholder="Logo / Gambar" required="required" value="{{ $server->image_path }}">
                                <span class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Deskripsi</label>
                                <textarea name="description" placeholder="Deskripsi" class="form-control" rows="5">{{ $server->description }}</textarea>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="pull-right">
                                <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                                <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        
    </div>

@endsection

@push('js')
    <script src="{{ url('assets/js/pages/permission-add-edit.js') }}"></script>
@endpush