<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use App\User;
use App\Program;
use App\Activity;
use App\SubActivity;
use App\Setting;
use App\Charts\SampleChart;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
		$users = User::get();
		$programs = Program::get();
		$activities = Activity::get();
		$sub_activities = SubActivity::get();
     	// $doctors = Doctor::get();
     	// $inpatient = Inpatient::get();
     	// $outpatient = Outpatient::get();
	
		// $today_inpatient = Inpatient::whereDate('created_at', today())->count();
		// $yesterday_inpatient = Inpatient::whereDate('created_at', today()->subDays(1))->count();
		// $inpatient_2_days_ago = Inpatient::whereDate('created_at', today()->subDays(2))->count();
		 
		// $chart = new SampleChart();
		// $chart->labels(['2 Hari Lalu', 'Kemarin', 'Hari Ini']);	
		// $chart->loaderColor('lightcoral');
		// $chart->title("Grafik Registrasi Pasien Rawat Inap", 14, '#666', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
		// $chart->dataset('Pasien Rawat Inap', 'bar', [$inpatient_2_days_ago, $yesterday_inpatient, $today_inpatient])->backgroundColor('lightcoral');

		// $today_outpatient = Outpatient::whereDate('created_at', today())->count();
		// $yesterday_outpatient = Outpatient::whereDate('created_at', today()->subDays(1))->count();
		// $outpatient_2_days_ago = Outpatient::whereDate('created_at', today()->subDays(2))->count();
		 
		// $chart2 = new SampleChart;
		// $chart2->labels(['2 Hari Lalu', 'Kemarin', 'Hari Ini']);	
		// $chart2->loaderColor('lightgreen');
		// $chart2->title("Grafik Registrasi Pasien Rawat Jalan", 14, '#666', true, "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif");
		// $chart2->dataset('Pasien Rawat Jalan', 'bar', [$outpatient_2_days_ago, $yesterday_outpatient, $today_outpatient])->backgroundColor('lightgreen');

        return view('pages.dashboard', compact(['users', 'programs', 'activities', 'sub_activities']));
    }

    public function getDataUser(Request $request)
    {
    	$users = User::with(['user_data', 'tokens'])->where(function($where) use ($request){

    				if ($request->status == 'Online') {

    					$where->whereHas('tokens');
    				}

    				if ($request->status == 'Offline') {
    					$where->doesntHave('tokens');
    				}

                    if (!empty($request->name)) {
                        $where->whereHas('user_data', function($where) use ($request){
                            $where->where('name', 'like', '%'.$request->name.'%');
                        });
                    }

    			})->get();

    	return DataTables::of($users)

    	->rawColumns(['options'])

    	->addColumn('status', function($user){
    		if (count($user->tokens) > 0) {
    			return 'Online';
    		} else {
    			return 'Offline';
    		}
    	})

    	->addColumn('options', function($user){

    		return count($user->tokens) > 0 ? '<a class="btn btn-link text-danger" href="'.url('dashboard/revoke/'.$user->id).'" data-toggle="tooltip" title="Revoke Access">
    					<i class="fa fa-close"></i>
					</a>' : '';

    	})

    	->toJson();
    }

    public function revoke($id)
    {
    	$user = User::find($id);

    	$user->tokens->each(function($token, $key){
            $token->delete();
        });

        return redirect()
        		->back();
    }
}
