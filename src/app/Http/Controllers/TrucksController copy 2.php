<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trucks;
use App\Models\Truck_subunits;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Contracts\Validation\Validator;

class TrucksController extends Controller
{
    public function index(){
        $trucks = Trucks::all();
        $trucks_subunits = Truck_subunits::all();
        return view('trucks.index', ['trucks' => $trucks, 'subunits' => $trucks_subunits]);
    }
    public function create(){
        return view('trucks.create');
    }
    public function store(Request $request){
        $data = $request->validate([
            'unit_number' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:'.(date('Y')+5),
            'notes' => 'nullable',
        ]);

        $newTrucks = Trucks::create($data);
 
        return redirect(route('trucks.index'));
    }
    public function edit(Trucks $trucks){
        return view('trucks.edit', ['trucks' => $trucks]);
    }
    public function update(Trucks $trucks, Request $request){
        $data = $request->validate([
            'unit_number' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:'.(date('Y')+5),
            'notes' => 'nullable',
        ]);

        $trucks->update($data);
 
        return redirect(route('trucks.index'))->with('success', 'Truck updated succesffully');
    }
    public function delete(Trucks $trucks){

        $trucks->delete();
 
        return redirect(route('trucks.index'))->with('success', 'Truck deleted succesffully');
    }
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
           
        //    dd($getStartDatesById);
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
            // dd($getStartDatesById);
                if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
                    return back()->withErrors('Truck allready has a subunit1');
                }
                if (($startDateToCheck < $startDate) && ($endDateToCheck > $endDate)) {
                // return back()->withErrors('Truck '.$request->get('main_truck')." allready has a subunit ".implode( " ", $getStartDatesById )." ".implode( ',', $getEndDatesById ));
                // return view('trucks.subunits', ['trucks' => $trucks, 'getStartDatesById' => $getStartDatesById]);
                // return back()->with('success', 'test');
                // return back()->withErrors($getStartDatesById);
                // return back()->withErrors(['getStartDatesById' => $getStartDatesById]);
                return view('trucks.assignsubunits',['trucks' => $trucks, 'getStartDatesById' => $getStartDatesById, 'getEndDatesById' => $getEndDatesById]);
                }
            }
            // dd($getStartDatesById);
            // $items = array();
            // foreach($getStartDatesById as $getStartDateById) {
            //     $items[] = $getStartDateById;
            //     // if (($startDateToCheck < $startDate) && ($endDateToCheck > $endDate)) {
            //     //     return back()->withErrors('Truck '.$request->get('main_truck').' allready has a subunit '.implode(" ", $items));
            //     // }
            // }
            // if (($startDateToCheck < $startDate) && ($endDateToCheck > $endDate)) {
            //     return back()->withErrors('Truck '.$request->get('main_truck').' allready has a subunit '.implode(" ", $items).'<br>');
            // }
            
            // if (($startDateToCheck < $startDate) && ($endDateToCheck > $endDate)) {
            //     return back()->withErrors('Truck '.$request->get('main_truck').' allready has a subunit '.implode("<br>", $items));
            // }

            $test = $request->get('main_truck');
                $truck = Trucks::where('unit_number', $test)->value('id');
                $subunit = new Truck_subunits;
                $subunit->trucks_id = $truck;

                $data = $request->validate([
                    // 'trucks_id' => 'required',
                    'main_truck' => 'required',
                    
                    'subunit' => 'required',
                    'start_date' => 'required|date_format:Y-m-d',
                    'end_date' => 'required|date_format:Y-m-d',
                    
                ]);
                
                // if ($validator->fails()) {
                //     return redirect('post/create')
                //                 ->withErrors($validator)
                //                 ->withInput();
                // }

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
        
        // $users = App\User::where('active', 1)->get();
 
        // foreach ($users as $user) {
        //     echo $user->name;
        // }

// // $test22 = Truck_subunits::where('main_truck', $request->get('main_truck'))->get('trucks_id');
// $getId = Truck_subunits::where('main_truck', $request->get('main_truck'))
//          ->pluck('trucks_id')
//          ->all();
        
// // $trucksDate = []; 
// // foreach ($test22 as $p) {
// //     $test111 = $p->trucks_id;
// //     $trucksDate[] = $test111;
// // //     echo " $test111 <br>";
// // // var_dump($test111);
// //     $test44 = Truck_subunits::where('trucks_id', $test111)->value('start_date');
// //     $test55 = Truck_subunits::where('trucks_id', $test111)->value('end_date');

// //     $startDate = Carbon::parse($test44);
// //     $endDate = Carbon::parse($test55);
// //     $startDateToCheck = Carbon::parse($request->get('start_date'));
// //     $endDateToCheck = Carbon::parse($request->get('end_date'));

// //     dd( $test111, $trucksDate, $test44, $test55);
    
// //     if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
// //         return back()->withErrors('Truck '.$request->get('main_truck').'allready has a subunit from '.$test44.' to '.$test55);
// //     }
// //     }
// //     $products = []; 
// //    foreach(session('products') as $session){
// //       $post=Post::find($session->id);
// //       $trucksDate[] = $post;
// //    }
//     // die();
//         // dd($test22, $getId);

//         // $test44 = Truck_subunits::where('trucks_id', $getId)->value('start_date');
//         $getId11 = Truck_subunits::where('trucks_id', $getId)
//             ->orderBy('start_date', 'ASC')
//             ->pluck('start_date')
//             ->first();
//         // $test55 = Truck_subunits::where('trucks_id', $getId)->value('end_date');
//         $getId22 = Truck_subunits::where('trucks_id', $getId)
//             ->orderBy('end_date', 'DESC')
//             ->pluck('end_date')
//             ->first();
//         // $getId11Implode = implode(" ",$getId11);
//         // $getId22Implode = implode(" ",$getId22);
//         // dd($getId11, $getId22);
//         // $trucksDate = [];
//         // foreach ($getId11 as $p) {
//         //     // $trucksDate[] = $p;
//         //     //     $trucksDate[] = $test111;
//         //     //     echo " $test111 <br>";
//         //     // var_dump($test111);
//         //         // $test44 = Truck_subunits::where('trucks_id', $p)->value('start_date');
//         //         // $test55 = Truck_subunits::where('trucks_id', $test111)->value('end_date');
            
//         //         $startDate = Carbon::parse($p);
//         //         // $endDate = Carbon::parse($test55);
//         //         $startDateToCheck = Carbon::parse($request->get('start_date'));
//         //         // $endDateToCheck = Carbon::parse($request->get('end_date'));
//         //         foreach ($getId22 as $p1) {
    
//         //                 // $startDate = Carbon::parse($p);
//         //                 $endDate = Carbon::parse($p1);
//         //                 // $startDateToCheck = Carbon::parse($request->get('start_date'));
//         //                 $endDateToCheck = Carbon::parse($request->get('end_date'));
    
//         //                 }
//         //                 if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//         //                     return back()->withErrors('Truck allready has a subunit');
//         //                 }
            
//         //         // dd($startDateToCheck);
//         // //         $startDate = Carbon::parse($trucksDate);
//         // // $endDate = Carbon::parse($getId22);
//         //         }
//         //         dd($startDateToCheck);
//         // //         dd($trucksDate, $getId11, $p);
//         //         die();
//         $startDate = Carbon::parse($getId11);
//         $endDate = Carbon::parse($getId22);
//         $startDateToCheck = Carbon::parse($request->get('start_date'));
//         $endDateToCheck = Carbon::parse($request->get('end_date'));

//         // // dd($test22, $test44, $test55, $startDate, $endDate, $startDateToCheck, $endDateToCheck);
//         // dd($getId, $getId11, $getId22, $getId11Implode, $getId22Implode, $startDate, $endDate);
//         if (($startDateToCheck < $startDate) || ($endDateToCheck > $endDate)) {
//             return back()->withErrors('Truck allready has a subunit');
//         }

        
//         if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//             return back()->withErrors('Truck '.$request->get('main_truck').'allready has a subunit from '.$getId11.' to '.$getId22);
//         }

//         if($request->get('main_truck') == $request->get('subunit')){
//             return back()->withErrors('Main truck and subunit cant be the same!');
//         }
//         if (Truck_subunits::where('subunit', '=', $request->get('main_truck'))->exists()) {
//             return back()->withErrors('This truck allready subunit, you cant assign to subunit another subunit!');
//         }

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