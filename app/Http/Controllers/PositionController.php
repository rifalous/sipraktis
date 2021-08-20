<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Position;

use DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $position = Position::get();
        
        if ($request->wantsJson()) {
            return response()->json($position, 200);
        }

        return view('pages.position');        
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
            'position_name' => 'required'
        ]); 
        
        $position = new position;
        $position->position_name = $request->position_name;
        $position->save();
       
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('position.index')
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
        $position = position::get();
        
        if (empty($position)) {
            return response()->json('position not found', 500);
        }

        return response()->json($position, 200);
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
            'position_name' => 'required'
        ]);
        
        $position = position::find($id);

        if (empty($position)) {
            return response()->json('position not found', 500);
        }

        $position->position_name = $request->position_name;
        $position->save();

        if ($request->wantsJson()) {
            return response()->json($position);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('position.index')
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
        $position = position::find($id);

        if (empty($position)) {
            return response()->json('position not found', 500);
        }

        $position->delete();

        if($request->wantsJson()) {
            return response()->json('position deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                    ->route('position.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $position = position::get();
        return DataTables::of($position)
        ->rawColumns(['options'])

        ->addColumn('options', function($position){
            return '
                <a href="'.route('position.edit', $position->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$position->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('position.destroy', $position->id).'" method="POST" id="form-delete-'.$position->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }


    public function create()
    {
        $position = position::get();

        return view('pages.position.create');
    }

    public function edit($id)
    {
        $position = position::find($id);

        return view('pages.position.edit', compact(['position']));
    }
}


