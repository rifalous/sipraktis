<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggaran;
use App\Program;

use DB;
use PDF;
use DataTables;
use Helper;
use Excel;
use Carbon\Carbon;
use App\User;
use App\UserData;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::whereRaw('LENGTH(email) = 18')->get();
        $programs = Program::get();

        if ($request->wantsJson()) {
            return response()->json($programs, 200);    
        }
        
        return view('pages.report', compact(['programs']));
    }

    public function cetak(Request $request)
    {
        if ($request->submit == 'pdf') {
            // return "Cetak PDF";
            if (empty($request->program_id)) {
                $anggarans = DB::table('rekap_anggarans')
                ->select('rekap_anggarans.*','programs.program_name','programs.kode as program_kode',
                'activity.activity_name','activity.kode as activity_kode','sub_activity.sub_activity_name',
                'sub_activity.kode as sub_activity_kode','rincians.rincian_name','rincians.kode as rincian_kode')        
                ->join('programs','programs.id','=','rekap_anggarans.program_id')
                ->join('activity','activity.id','=','rekap_anggarans.activity_id')
                ->join('sub_activity','sub_activity.id','=','rekap_anggarans.sub_activity_id')
                ->join('rincians','rincians.id','=','rekap_anggarans.rincian_id')
                ->get();

                $user = DB::table('users')
                        ->select('users.id','users.name','users.section_id','users.nip','sections.section_name','positions.position_name')
                        ->join('sections','sections.id','=','users.section_id')
                        ->join('positions','positions.id','=','users.position_id')
                        ->where('users.id', \Auth::user()->id)
                        ->first();
                        
                return view('pdf.report_anggaran_global', compact(['anggarans', 'user']));
                // $pdf = PDF::loadview('pdf.report_anggaran_global', compact(['anggarans', 'user']));
                // return $pdf->download('Anggaran'.'.pdf');
                // return response()->json($anggarans, 200);
            }
            else {
                $anggarans = DB::table('rekap_anggarans')
                ->select('rekap_anggarans.*','programs.program_name','programs.kode as program_kode',
                'activity.activity_name','activity.kode as activity_kode','sub_activity.sub_activity_name',
                'sub_activity.kode as sub_activity_kode','rincians.rincian_name','rincians.kode as rincian_kode')        
                ->join('programs','programs.id','=','rekap_anggarans.program_id')
                ->join('activity','activity.id','=','rekap_anggarans.activity_id')
                ->join('sub_activity','sub_activity.id','=','rekap_anggarans.sub_activity_id')
                ->join('rincians','rincians.id','=','rekap_anggarans.rincian_id')
                ->where('rekap_anggarans.program_id', $request->program_id)
                ->get();
                // $user = User::where('id', $request->user_id)->get();
                
                $user = DB::table('users')
                        ->select('users.id','users.name','users.section_id','users.nip','sections.section_name','positions.position_name')
                        ->join('sections','sections.id','=','users.section_id')
                        ->join('positions','positions.id','=','users.position_id')
                        ->where('users.id', \Auth::user()->id)
                        ->first();
                        
                return view('pdf.report_anggaran', compact(['anggarans', 'user']));
                // $pdf = PDF::loadview('pdf.report_anggaran', compact(['anggarans', 'user']));
                // return $pdf->download('Anggaran'.'.pdf');
                // return response()->json($user, 200);
            }
        }
        else {
            // return "Cetak Excel";
            if (empty($request->program_id)) {
                $data = Anggaran::select(
                    'programs.kode as program_kode',
                    'programs.program_name as program_name',
                    'activity.kode as activity_kode',
                    'activity.activity_name as activity_name',
                    'sub_activity.kode as sub_activity_kode',
                    'sub_activity.sub_activity_name as sub_activity_name',
                    'rincians.kode as rincian_kode',
                    'rincians.rincian_name as rincian_name',
                    'rekap_anggarans.keterangan',
                    'rekap_anggarans.volume',
                    'rekap_anggarans.satuan',
                    'rekap_anggarans.harga',
                    'rekap_anggarans.jumlah'
                )
                ->join('programs','programs.id','=','rekap_anggarans.program_id')
                ->join('activity','activity.id','=','rekap_anggarans.activity_id')
                ->join('sub_activity','sub_activity.id','=','rekap_anggarans.sub_activity_id')
                ->join('rincians','rincians.id','=','rekap_anggarans.rincian_id')
                ->get();
            }
            else {
                $data = Anggaran::select(
                    'programs.kode as program_kode',
                    'programs.program_name as program_name',
                    'activity.kode as activity_kode',
                    'activity.activity_name as activity_name',
                    'sub_activity.kode as sub_activity_kode',
                    'sub_activity.sub_activity_name as sub_activity_name',
                    'rincians.kode as rincian_kode',
                    'rincians.rincian_name as rincian_name',
                    'rekap_anggarans.keterangan',
                    'rekap_anggarans.volume',
                    'rekap_anggarans.satuan',
                    'rekap_anggarans.harga',
                    'rekap_anggarans.jumlah'
                )
                ->join('programs','programs.id','=','rekap_anggarans.program_id')
                ->join('activity','activity.id','=','rekap_anggarans.activity_id')
                ->join('sub_activity','sub_activity.id','=','rekap_anggarans.sub_activity_id')
                ->join('rincians','rincians.id','=','rekap_anggarans.rincian_id')
                ->where('rekap_anggarans.program_id', $request->program_id)
                ->get();
            }
            return Excel::create('Data Anggaran', function($excel) use ($data){
                 $excel->sheet('mysheet', function($sheet) use ($data){
                     $sheet->fromArray($data);
                 });
            })->download('xls');
        }

    }
}