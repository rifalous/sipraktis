<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RincianBelanja;

use DB;
use DataTables;
use Helper;
use Carbon\Carbon;

class RincianBelanjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        return view('pages.rincian');
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

            $rincian                    = new RincianBelanja;
            $rincian->kode              = $request->kode;
            $rincian->rincian_name      = $request->rincian_name;
            // $rincian->program_id        = $request->program_id;
            // $rincian->activity_id       = $request->activity_id;
            // $rincian->sub_activity_id   = $request->sub_activity_id;
            
            $rincian->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('rincian')
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
        $rincian = RincianBelanja::find($id);

        if (empty($rincian)) {
            return response()->json('Rincian not found', 500);
        }

        return view('pages.rincian.show', compact(['rincian']));   
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
            $rincian                    = RincianBelanja::find($id);
            $rincian->kode              = $request->kode;
            $rincian->rincian_name      = $request->rincian_name;
            // $rincian->program_id        = $request->program_id;
            // $rincian->activity_id       = $request->activity_id;
            // $rincian->sub_activity_id   = $request->sub_activity_id;

            $rincian->save();

        });

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil disimpan!'
                ];

        return redirect('rincian')
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
        $rincian = RincianBelanja::find($id);
        
        if (empty($rincian)) {
            return response()->json('rincian not found', 500);
        }

        DB::transaction(function() use ($request, $rincian, $id){
            $rincian->delete();
        });
        

        if ($request->wantsJson()) {
            return response()->json('rincian deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                ->route('rincian.index')
                ->with($res);
    }

    public function getData(Request $request)
    {
        $rincians = RincianBelanja::get();

        return DataTables::of($rincians)

        ->rawColumns(['options', 'title'])

        ->addColumn('options', function($data){
            return '<a href="'. route('rincian.edit', $data->id) .'" class="btn btn-success btn-bordered waves-effect waves-light btn-xs">Edit</a>
                <button class="btn btn-danger btn-bordered waves-effect waves-light btn-xs" onClick="on_delete('.$data->id.')">Hapus</button>
                
                <form action="'. route('rincian.destroy', $data->id) .'" method="POST" id="form-delete-'.$data->id.'" style="display:none">
                    '. method_field('DELETE') .'
                    '. csrf_field() .'
                </form>
            ';
        })

        ->addColumn('title', function($data){

            return '<a href="'. route('rincian.show', $data->id) .'"><strong>'.$data->name.' ('.$data->display_name.')</strong></a>
                    <br>
                <small class="text-muted">Created at '.
                     Carbon::parse($data->created_at)->format('M jS, Y') 
                .'</small>';
        })

        ->toJson();
    }

    public function create()
    {
        return view('pages.rincian.create');                       
    }

    public function edit($id)
    {
        $rincian = RincianBelanja::find($id);

        return view('pages.rincian.edit', compact(['rincian']));
    }
}