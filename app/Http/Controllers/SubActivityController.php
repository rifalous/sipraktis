<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubActivity;

use DataTables;

class SubActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.sub-activity');        
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
            'sub_activity_name' => 'required'
        ]); 
        
        $sub_activity = new SubActivity;
        $sub_activity->kode = $request->kode;
        $sub_activity->sub_activity_name = $request->sub_activity_name;
        $sub_activity->save();
       
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('sub-activity.index')
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
        $sub_activity = SubActivity::get();
        
        if (empty($sub_activity)) {
            return response()->json('sub activity not found', 500);
        }

        return response()->json($sub_activity, 200);
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
            'sub_activity_name' => 'required'
        ]);
        
        $sub_activity = SubActivity::find($id);

        if (empty($sub_activity)) {
            return response()->json('sub activity not found', 500);
        }

        $sub_activity->kode = $request->kode;
        $sub_activity->sub_activity_name = $request->sub_activity_name;
        $sub_activity->save();

        if ($request->wantsJson()) {
            return response()->json($sub_activity);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('sub-activity.index')
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
        $sub_activity = SubActivity::find($id);

        if (empty($sub_activity)) {
            return response()->json('sub activity not found', 500);
        }

        $sub_activity->delete();

        if($request->wantsJson()) {
            return response()->json('sub activity deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                    ->route('sub-activity.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $sub_activity = SubActivity::get();
        return DataTables::of($sub_activity)
        ->rawColumns(['options'])

        ->addColumn('options', function($sub_activity){
            return '
                <a href="'.route('sub-activity.edit', $sub_activity->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$sub_activity->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('sub-activity.destroy', $sub_activity->id).'" method="POST" id="form-delete-'.$sub_activity->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }

    public function create()
    {
        $sub_activity = SubActivity::get();

        return view('pages.sub_activity.create');
    }

    public function edit($id)
    {
        $sub_activity = SubActivity::find($id);

        return view('pages.sub_activity.edit', compact(['sub_activity']));
    }
}


