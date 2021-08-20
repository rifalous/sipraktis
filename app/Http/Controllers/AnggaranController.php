<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggaran;
use App\Program;
use App\Activity;
use App\SubActivity;
use App\RincianBelanja;
use DB;
use DataTables;
use Helper;
use Carbon\Carbon;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        return view('pages.anggaran');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use ($request){

            $anggaran                   = new Anggaran;
            $anggaran->program_id       = $request->program_id;
            $anggaran->activity_id      = $request->activity_id;
            $anggaran->sub_activity_id  = $request->sub_activity_id;
            $anggaran->rincian_id       = $request->rincian_id;
            $anggaran->keterangan       = $request->keterangan;
            $anggaran->volume           = $request->volume;
            $anggaran->satuan           = $request->satuan;
            $anggaran->harga            = $request->harga;
            $anggaran->jumlah           = $request->jumlah;
            $anggaran->user_id          = \Auth::user()->id;
            
            $anggaran->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('anggaran')
                    ->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Park  $park
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            return response()->json('Role not found', 500);
        }

        if ($request->wantsJson()) {
            return response()->json($role->load('perms'), 200);    
        }

        return view('pages.role.show', compact(['role']));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function() use ($request, $id){
            $anggaran                   = Anggaran::find($id);
            $anggaran->program_id       = $request->program_id;
            $anggaran->activity_id      = $request->activity_id;
            $anggaran->sub_activity_id  = $request->sub_activity_id;
            $anggaran->rincian_id       = $request->rincian_id;
            $anggaran->keterangan       = $request->keterangan;
            $anggaran->volume           = $request->volume;
            $anggaran->satuan           = $request->satuan;
            $anggaran->harga            = $request->harga;
            $anggaran->jumlah           = $request->jumlah;
            $anggaran->user_id          = \Auth::user()->id;

            $anggaran->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('anggaran')
                    ->with($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $anggaran = Anggaran::find($id);
        
        if (empty($anggaran)) {
            return response()->json('anggaran not found', 500);
        }

        DB::transaction(function() use ($request, $anggaran, $id){
            $anggaran->delete();
        });
        

        if ($request->wantsJson()) {
            return response()->json('anggaran deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('anggaran.index')
                ->with($res);
    }

    public function getData(Request $request)
    {
        $user_id   = \Auth::user()->id;
        $anggarans = Anggaran::select('rekap_anggarans.*','programs.program_name as program_name',
        'activity.activity_name as activity_name',
        'sub_activity.sub_activity_name as sub_activity_name',
        'rincians.rincian_name as rincian_name')
        ->where('user_id', $user_id)
        ->join('programs','programs.id','=','rekap_anggarans.program_id')
        ->join('activity','activity.id','=','rekap_anggarans.activity_id')
        ->join('sub_activity','sub_activity.id','=','rekap_anggarans.sub_activity_id')
        ->join('rincians','rincians.id','=','rekap_anggarans.rincian_id')
        ->get();
        
        // $anggarans = DB::table('rekap_anggarans')
        // ->select('rekap_anggarans.*','programs.program_name as program_name',
        // 'activity.activity_name as activity_name','sub_activity.sub_activity_name as sub_activity_name',
        // 'rincians.rincian_name as rincian_name')        
        // ->join('programs','programs.id','=','rekap_anggarans.program_id')
        // ->join('activity','activity.id','=','rekap_anggarans.activity_id')
        // ->join('sub_activity','sub_activity.id','=','rekap_anggarans.sub_activity_id')
        // ->join('rincians','rincians.id','=','rekap_anggarans.rincian_id')
        // ->where('user_id', $user_id)
        // ->get();

        // return response()->json($anggarans, 200);

        return DataTables::of($anggarans)

        ->rawColumns(['options', 'title'])

        ->addColumn('options', function($data){
            return '<a href="'. route('anggaran.edit', $data->id) .'" class="btn btn-success btn-bordered waves-effect waves-light btn-xs">Edit</a>
                <button class="btn btn-danger btn-bordered waves-effect waves-light btn-xs" onClick="on_delete('.$data->id.')">Hapus</button>
                
                <form action="'. route('anggaran.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>
            ';
        })

        ->addColumn('title', function($data){

            return '<a href="'. route('anggaran.show', $data->id) .'"><strong>'.$data->name.' ('.$data->display_name.')</strong></a>
                    <br>
                <small class="text-muted">Created at '.
                     Carbon::parse($data->created_at)->format('M jS, Y') 
                .'</small>';
        })

        ->toJson();
    }

    public function create()
    {
        $programs = Program::get();
        $activities = Activity::get();
        $sub_activities = SubActivity::get();
        $rincians = RincianBelanja::get();
        return view('pages.anggaran.create', compact(['programs', 'activities', 'sub_activities', 'rincians']));                      
    }

    public function edit($id)
    {
        $anggaran = Anggaran::find($id);
        $programs = Program::get();
        $activities = Activity::get();
        $sub_activities = SubActivity::get();
        $rincians = RincianBelanja::get();
        return view('pages.anggaran.edit', compact(['anggaran', 'programs', 'activities', 'sub_activities', 'rincians']));
    }
}