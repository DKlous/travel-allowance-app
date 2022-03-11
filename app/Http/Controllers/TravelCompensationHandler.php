<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facade\db\Database;
use Illuminate\Support\Facades\DB;

class TravelCompensationHandler extends Controller
{
    //
    public static function FetchTravelCompensationData(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $employees = DB::select('SELECT *, vehicle.vehicle_type FROM `employee`
        INNER JOIN `vehicle` ON employee.vehicle_id = vehicle.id');
        return view('welcome', ['employees' => $employees]);
    }
}
