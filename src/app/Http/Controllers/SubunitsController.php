<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trucks;
use App\Models\Truck_subunits;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Validation\Validator;

class SubunitsController extends Controller
{
    public function subunits(Request $request, Truck_subunits $subunits){
        $trucks = Trucks::all();

        $test = $request->get('main_truck');

        $truck = Trucks::where('unit_number', $test)->value('id');

        $subunit = new Truck_subunits;
        $subunit->trucks_id = $truck;

        $getId = Truck_subunits::where('main_truck', $request->get('main_truck'))
        ->pluck('trucks_id')
        ->all();
       
       $getStartDatesById = Truck_subunits::where('trucks_id', $getId)
           ->pluck('start_date')
           ->all();

       $getEndDatesById = Truck_subunits::where('trucks_id', $getId)
           ->pluck('end_date')
           ->all();

        return view('trucks.assignsubunits', ['trucks' => $trucks, 'getStartDatesById' => $getStartDatesById]);
    }
    public function createsubunit(Request $request){

        $trucks = Trucks::all();

        $test = $request->get('main_truck');

        $truck = Trucks::where('unit_number', $test)->value('id');

        $subunit = new Truck_subunits;
        $subunit->trucks_id = $truck;
      
        if($request->get('main_truck') == $request->get('subunit')){
            return back()->withErrors('Main truck and subunit cant be the same!');
        }
        if (Truck_subunits::where('subunit', '=', $request->get('main_truck'))->exists()) {
            return back()->withErrors('This truck allready subunit, you cant assign to subunit another subunit!');
        }

        $getId = Truck_subunits::where('main_truck', $request->get('main_truck'))
         ->pluck('trucks_id')
         ->all();
        
        $getStartDatesById = Truck_subunits::where('trucks_id', $getId)
            ->pluck('start_date')
            ->all();

        $getEndDatesById = Truck_subunits::where('trucks_id', $getId)
            ->pluck('end_date')
            ->all();

        $getStartDatesByIdFrom = 'This truck allready has a subuit from';

            for ($i = 0; $i < count($getStartDatesById) && $i < count($getEndDatesById); ++$i) {
                $getStartDateById = $getStartDatesById[$i];
                $getEndDateById = $getEndDatesById[$i];
            
                $startDate = Carbon::parse($getStartDateById);
                $startDateToCheck = Carbon::parse($request->get('start_date'));
            
                $endDate = Carbon::parse($getEndDateById);
                $endDateToCheck = Carbon::parse($request->get('end_date'));
                
                if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
                    return back()->withErrors('Truck allready has a subunit1');
                }
                if (($startDateToCheck < $startDate) && ($endDateToCheck > $endDate)) {
                return view('trucks.assignsubunits',['trucks' => $trucks, 'getStartDatesById' => $getStartDatesById, 'getEndDatesById' => $getEndDatesById]);
                }
            }

            $test = $request->get('main_truck');
                $truck = Trucks::where('unit_number', $test)->value('id');
                $subunit = new Truck_subunits;
                $subunit->trucks_id = $truck;

                $data = $request->validate([
                    'main_truck' => 'required',
                    'subunit' => 'required',
                    'start_date' => 'required|date_format:Y-m-d',
                    'end_date' => 'required|date_format:Y-m-d',
                    
                ]);

                $newSubunit = Truck_subunits::create([
                    'trucks_id' => $truck,
                    'main_truck' => $request->main_truck,
                    'subunit' => $request->subunit,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);
       
        return redirect(route('trucks.index'));
    }
    public function editsubunit(Truck_subunits $subunits){
        $trucks = Trucks::all();
        return view('trucks.editsubunit', ['subunits' => $subunits, 'trucks' => $trucks]);
    }
    public function updatesubunit(Truck_subunits $subunits, Request $request){

        $getId = Truck_subunits::where('main_truck', $request->get('main_truck'))
         ->pluck('trucks_id')
         ->all();
        
        $getStartDatesById = Truck_subunits::where('trucks_id', $getId)
            ->pluck('start_date')
            ->all();

        $getEndDatesById = Truck_subunits::where('trucks_id', $getId)
            ->pluck('end_date')
            ->all();

            for ($i = 0; $i < count($getStartDatesById) && $i < count($getEndDatesById); ++$i) {
                $getStartDateById = $getStartDatesById[$i];
                $getEndDateById = $getEndDatesById[$i];
            
                $startDate = Carbon::parse($getStartDateById);
                $startDateToCheck = Carbon::parse($request->get('start_date'));
            
                $endDate = Carbon::parse($getEndDateById);
                $endDateToCheck = Carbon::parse($request->get('end_date'));
            
                if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
                    return back()->withErrors('Truck allready has a subunit1');
                }
            }
            if (($startDateToCheck < $startDate) && ($endDateToCheck > $endDate)) {
                return back()->withErrors('Truck allready has a subunit2');
            }

        $data = $request->validate([
            // 'main_truck' => 'required',
            'subunit' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
        ]);

        $subunits->update($data);
 
        return redirect(route('trucks.index'))->with('success', 'Subunit updated succesffully');
    }
    public function deletesubunit(Truck_subunits $subunits){

        $subunits->delete();
 
        return redirect(route('trucks.index'))->with('success', 'Subunit deleted succesffully');
    }
}