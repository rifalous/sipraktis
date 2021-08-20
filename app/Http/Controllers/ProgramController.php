<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;

use DataTables;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pages.program');        
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
            'program_name' => 'required'
        ]); 
        
        $program = new program;
        $program->kode = $request->kode;
        $program->program_name = $request->program_name;
        $program->save();
       
        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data success!'
                ];

        return redirect()
                ->route('program.index')
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
        $program = program::get();
        
        if (empty($program)) {
            return response()->json('program not found', 500);
        }

        return response()->json($program, 200);
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
            'program_name' => 'required'
        ]);
        
        $program = program::find($id);

        if (empty($program)) {
            return response()->json('program not found', 500);
        }

        $program->kode = $request->kode;
        $program->program_name = $request->program_name;
        $program->save();

        if ($request->wantsJson()) {
            return response()->json($program);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil diubah!'
                ];

        return redirect()
                ->route('program.index')
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
        $program = program::find($id);

        if (empty($program)) {
            return response()->json('program not found', 500);
        }

        $program->delete();

        if($request->wantsJson()) {
            return response()->json('program deleted', 200);
        }

        $res = [
                    'title' => 'Sukses',
                    'type' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ];

        return redirect()
                    ->route('program.index')
                    ->with($res);
    }

    public function getData(Request $request)
    {
        $program = program::get();
        return DataTables::of($program)
        ->rawColumns(['options'])

        ->addColumn('options', function($program){
            return '
                <a href="'.route('program.edit', $program->id).'" class="btn btn-success btn-xs" data-toggle="tooltip" title="Edit"><i class="mdi mdi-pencil"></i></a>
                <button class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="on_delete('.$program->id.')"><i class="mdi mdi-close"></i></button>
                <form action="'.route('program.destroy', $program->id).'" method="POST" id="form-delete-'.$program->id .'" style="display:none">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                </form>
            ';
        })

        ->toJson();
    }


    public function create()
    {
        $program = Program::get();

        return view('pages.program.create');
    }

    public function edit($id)
    {
        $program = Program::find($id);

        return view('pages.program.edit', compact(['program']));
    }
}


