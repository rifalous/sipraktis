@extends('layouts.master')

@section('title')
	Tambah User
@endsection

@section('content')

@php($active = 'user')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                <h4 class="page-title">Tambah User</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="{{ url('user') }}">User</a></li>
                    <li class="active">
                    Tambah User
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
                <form action="{{ route('user.store') }}" method="post" id="form-add-edit" enctype="multipart/form-data">
                    @csrf

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Nama" class="form-control" required="required">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">NIP <span class="text-danger">*</span></label>
                            <input type="nip" name="nip" placeholder="NIP" class="form-control" required="required">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email <span class="text-danger">*</span></label>
                            <input type="text" name="email" placeholder="Email" class="form-control" required="required">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Status<span class="text-danger">*</span></label>
                            <select name="status" class="select2" data-placeholder="Pilih Status" data-allow-clear="true" required="required">
                                <option></option>
                                @foreach ($status as $status)
                                    <option value="{{ $status['id'] }}">{{ $status['text'] }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Foto</label>
                            <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Golongan</label>
                            <select name="section_id" class="select2" data-placeholder="Pilih Golongan" data-allow-clear="true">
                                <option></option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section['id'] }}">{{  $section['section_code'].' - '.$section['section_name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Jabatan</label>
                            <select name="position_id" class="select2" data-placeholder="Pilih Jabatan" data-allow-clear="true">
                                <option></option>
                                @foreach ($positions as $position)
                                    <option value="{{ $position['id'] }}">{{ $position['position_name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Kata Sandi<span class="text-danger">*</span></label>
                            <input type="password" name="password" minlength="6" placeholder="Password" class="form-control" required="required">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Ulangi Kata Sandi<span class="text-danger">*</span></label>
                            <input type="password" name="retype_password" minlength="6" placeholder="Ulangi Password" class="form-control" required="required">
                            <span class="help-block"></span>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <!-- <div class="form-group">
                            <label class="control-label">Peran User<span class="text-danger">*</span></label>
                            <select name="roles[]" class="select2" data-placeholder="Peran User" multiple="multiple" required="required">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div> -->
                        
                        <div class="form-group">
                            <label class="control-label">Peran User<span class="text-danger">*</span></label>
                            <select name="roles[]" class="select2" data-placeholder="Peran User" data-allow-clear="true" required="required">
                                <option></option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="col-md-12 text-right">
                        <hr>

                        <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>

                    </div>

                    <div class="clearfix"></div>

                </form>
            </div>
        </div>
    </div>

</div> <!-- container -->

@endsection

@push('js')
<script src="{{ url('assets/js/pages/user-add-edit.js') }}"></script>
@endpush