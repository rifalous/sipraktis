@extends('layouts.master')

@section('title')
	Ubah User
@endsection

@section('content')

@php($active = 'user')

<div class="container">
    <div class="row">
		<div class="col-xs-12">
			<div class="page-title-box">
                
                <h4 class="page-title">Ubah User</h4>
                <ol class="breadcrumb p-0 m-0">
                    <li><a href="{{ url('user') }}">User</a></li>
                    <li class="active">
                        Ubah User
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
                <form action="{{ route('user.update', $user->id) }}" method="post" id="form-add-edit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" value="{{ $user->id }}" hidden="hidden">

                    
                    @csrf

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" placeholder="Nama" class="form-control" required="required" value="{{ $user->name }}">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email <span class="text-danger">*</span></label>
                            <input type="text" name="email" placeholder="Email" class="form-control" required="required" value="{{ $user->email }}">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">NIP <span class="text-danger">*</span></label>
                            <input type="nip" name="nip" placeholder="NIP" class="form-control" required="required" value="{{ $user->nip }}">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Foto</label>
                            <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg">
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="control-label">Golongan</label>
                                <select name="section_id" class="select2" data-placeholder="Pilih Golongan" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"{{ $section['id'] == $user->section_id ? 'selected=selected' : '' }}>{{ $section['section_code'].' - '.$section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Jabatan</label>
                                <select name="position_id" class="select2" data-placeholder="Pilih Jabatan" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}"{{ $position['id'] == $user->position_id ? 'selected=selected' : '' }}>{{ $position->position_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Kata Sandi</label>
                            <input type="password" name="password" minlength="6" placeholder="Kata Sandi" class="form-control">
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Ulangi Kata Sandi</label>
                            <input type="password" name="retype_password" minlength="6" placeholder="Ulangi Kata Sandi" class="form-control">
                            <span class="help-block"></span>
                            <span class="text-muted text-italic">*) Kosongkan kata sandi, jika tidak ingin mengubahnya</span>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label class="control-label">Peran User<span class="text-danger">*</span></label>
                            <select name="roles[]" class="select2" data-placeholder="Peran" multiple="multiple" required="required">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, $user->roles()->pluck('id')->toArray()) ? 'selected=selected' : '' }}>{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="col-md-12 text-right">
                        <hr>

                        <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                        <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan Perubahan</button>

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