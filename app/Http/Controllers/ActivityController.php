<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

use DataTables;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.activity');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
       $request->validate([
            'kode' => 'required',
            'activity_name' => 'required'
        ]); 
        
        $activity = new activity;
        $activity->kode = $request->kode;
        $activity->activity_name = $request->activity_name;
        $activity->save();
       
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('activity.index')
                ->with($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Park  $park
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = activity::get();
        
        if (empty($activity)) {
            return response()->json('activity not found', 500);
        }

        return response()->json($activity, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'activity_name' => 'required'
        ]);
        
        $activity = activity::find($id);

        if (empty($activity)) {
            return response()->json('activity not found', 500);
        }

        $activity->kode = $request->kode;
        $activity->activity_name = $request->activity_name;
        $activity->save();

        if ($request->wantsJson()) {
            return response()->json($activity);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('activity.index')
                ->with($res);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $activity = activity::find($id);

        if (empty($activity)) {
            return response()->json('activity not found', 500);
        }

        $activity->delete();

        if($request->wantsJson()) {
            return response()->json('activity deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                    ->route('activity.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $activity = activity::get();
        return DataTables::of($activity)
        ->rawColumns(['options'])

        ->addColumn('options', function($activity){
            return '
                <a href="'.route('activity.edit', $activity->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$activity->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('activity.destroy', $activity->id).'" method="POST" id="form-delete-'.$activity->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }


    public function create()
    {
        $activity = activity::get();

        return view('pages.activity.create');
    }

    public function edit($id)
    {
        $activity = activity::find($id);

        return view('pages.activity.edit', compact(['activity']));
    }
}


