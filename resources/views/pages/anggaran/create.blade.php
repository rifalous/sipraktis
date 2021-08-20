@extends('layouts.master')
@section('title')
	Tambah Data
@endsection

@section('content')

@php($active = 'anggaran')
	
	<div class="container">

        <div class="row">
			<div class="col-xs-12">
				<div class="page-title-box">
                    <h4 class="page-title">Tambah Data</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="{{ route('anggaran.index') }}">Anggaran</a>
                        </li>
                        <li class="active">
                            Tambah Data
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
			</div>
		</div>
        <!-- end row -->


        <form action="{{ route('anggaran.store') }}" method="post" id="form-add-edit">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-content">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Program <span class="text-danger">*</span></label>
                                <select name="program_id" class="select2" data-placeholder="Pilih Program" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program['id'] }}">{{  $program['kode'].' - '.$program['program_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Kegiatan <span class="text-danger">*</span></label>
                                <select name="activity_id" class="select2" data-placeholder="Pilih Kegiatan" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity['id'] }}">{{  $activity['kode'].' - '.$activity['activity_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Sub Kegiatan <span class="text-danger">*</span></label>
                                <select name="sub_activity_id" class="select2" data-placeholder="Pilih Sub Kegiatan" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($sub_activities as $sub_activity)
                                        <option value="{{ $sub_activity['id'] }}">{{  $sub_activity['kode'].' - '.$sub_activity['sub_activity_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Rincian Belanja <span class="text-danger">*</span></label>
                                <select name="rincian_id" class="select2" data-placeholder="Pilih Rincian Belanja" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($rincians as $rincian)
                                        <option value="{{ $rincian['id'] }}">{{  $rincian['kode'].' - '.$rincian['rincian_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Keterangan</label>
                                <textarea name="keterangan" placeholder="Keterangan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>

                        <!-- <div class="col-md-6" style="visibility:hidden">
                            <div class="form-group">
                                <label class="control-label">Kode<span class="text-danger">*</span></label>
                                <input type="text" name="test" class="form-control" placeholder="Kode" >
                            </div>
                        </div> -->


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Volume <span class="text-danger">*</span></label>
                                <input type="text" name="volume" id="volume" class="form-control" placeholder="Volume" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Satuan</label>
                                <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Harga <span class="text-danger">*</span></label>
                                <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Jumlah <span class="text-danger">*</span></label>
                                <input readonly type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Jumlah" required="required">
                                <span class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="pull-right">
                                <button class="btn btn-default btn-bordered waves-effect waves-light" type="reset">Reset</button>
                                <button class="btn btn-primary btn-bordered waves-effect waves-light" type="submit">Simpan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
        
    </div>

@endsection

@push('js')
    <script src="{{ url('assets/js/pages/anggaran-create-edit.js') }}"></script>
    <script src="{{ url('assets/js/pages/anggaran-count.js') }}"></script>
@endpush