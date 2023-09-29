<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trucks;
use App\Models\Truck_subunits;
use Carbon\Carbon;

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
    public function subunits(){
        $trucks = Trucks::all();
        return view('trucks.subunits', ['trucks' => $trucks]);
    }
    public function createsubunit(Request $request){

        $test = $request->get('main_truck');

        // $truck = Trucks::whereHas('subunit',function($query){
        //     $query->where('subunit','like','%$test%');
        // })->get();

        $truck = Trucks::where('unit_number', $test)->value('id');

        // dd($test);

        // $code= random_int(100000,999999);   
        // $found = Student::where('code', $code)->count();
        // if($found == 0)
        // {
        //     $student->student_code = $code;
        // } 

        // dd();

        // $truck = Trucks::where('id',1)->with(['subunit:id,trucks_id,subunit'])->get();

        // $truck = Trucks::where('id',1)->with(['subunit' => function($query) {
        //     $query->orderBy('id','desc');
        // }])->get();
        // foreach ($truck as $subunit){ 
        //     dd($subunit->subunit);
        // }
        
        // $student = Student::has('comment')->get();
        // $truck = Trucks::find($request->get('main_truck'));
// // dd($truck);
        $subunit = new Truck_subunits;
        $subunit->trucks_id = $truck;
        // $subunit->main_truck = 'aaa123';
        // $subunit->subunit = 'test1';
        // $subunit->start_date = '2023-06-06';
        // $subunit->end_date = '2023-07-10';
        // $subunit->save();
        // dd($subunit);
//         // $date = Carbon::createFromFormat('d/m/Y', now());

    //     $date = Truck_subunits::where($request->get('main_truck'), '<=', $request->get('start_date'))
    // ->where($request->get('main_truck'), '>=', $request->get('end_date'))
    // ->get();
    // dd($date);

    // $user = Truck_subunits::find(1)->main_truck;
    // dd($user);

    // // dd($request->get('start_date'), $request->get('end_date'), Truck_subunits::where('start_date'), Truck_subunits::where('end_date'));
    // // print_r($date);
    // $hasSubunit = Truck_subunits::where('id', Auth::user()->id)->whereNotNull('image')->exists();
    // dd($hasSubunit);
    // if (Truck_subunits::where('main_truck.id', '=', 'subunit.id')) {
    //     return back()->withErrors('This truck allready has a subunit!');
    //  }
    //  if($request->get('main_truck')->id() == Truck_subunits::select('subunit')->id()){
    //     return back()->withErrors('This truck allready has a subunit!');
    // }
    // if ($request->get('main_truck')->exists()) {
    //     return back()->withErrors('This truck allready has a subunit!');
    //  }
    // dd($request->post('main_truck'));
    // dd($request->get('main_truck'));
    // dd(Truck_subunits::where('main_truck', '=', $request->get('main_truck'))->exists());

    // $phone = Trucks::find(1)->truckSubunit;

    // var_dump($phone);

    //  if (Truck_subunits::where('main_truck', '=', $request->get('main_truck'))->exists()) {
    //     $unitNumber = Trucks::select('unit_number')->get();
    //     $mainTruck = Truck_subunits::select('main_truck')->get();

    //     $unitNumber = $mainTruck;

    //     dd($unitNumber);

    //     return back()->withErrors('This truck allready has a subunit!');
    //  }
    
    // $test = Truck_subunits::select('subunit');

    // if(is_null( $test)) // <----
    // {
    //     // ...
    // }

    //  if (Truck_subunits::where('id', '=', $request->get('subunit'))) {
    //     return back()->withErrors('This truck allready has a subunit!');
    //  }
    // // var_dump($date);
        // if(!$date){
        //     // dd($date[0]);
        //     return back()->withErrors('Main trucks allready has subunit on this date');        // }
        // return back()->withErrors('Main trucks allready has subunit on this date');
    
//     // $schedule = Truck_subunits::where('start_date', '<=', Carbon::now())
//     // ->where('end_date', '>=', Carbon::now())
//     // ->get();
// //or
// // $schedule = Truck_subunits::whereRaw('(now() between start_date and end_date)')->get();
//         // $date = Truck_subunits::where('start_date')->where('end_date')->get();
//         // dd(now());
//         dd($schedule);
        if($request->get('main_truck') == $request->get('subunit')){
            return back()->withErrors('Main truck and subunit cant be the same!');
        }
        if (Truck_subunits::where('subunit', '=', $request->get('main_truck'))->exists()) {
            return back()->withErrors('This truck allready subunit, you cant assign to subunit another subunit!');
        }

        // // $test22 = Truck_subunits::where('main_truck', '=', $request->get('main_truck'))->first();
        // $test22 = Truck_subunits::where('main_truck', $request->get('main_truck'))->value('trucks_id');
        // $test33 = Trucks::where('unit_number', $request->get('main_truck'))->value('id');
        // $test44 = Truck_subunits::where('trucks_id', $test22)->value('start_date');
        // $test55 = Truck_subunits::where('trucks_id', $test22)->value('end_date');
        // // dd($test44, $test55);

        // // if($request->get('start_date') < $test44){
        // //     echo 'ok';
        // //     else{
        // //         echo 'not ok';
        // //     }
        // // }

        // $startDate = Carbon::parse($test44);
        // $endDate = Carbon::parse($test55);
        // $startDateToCheck = Carbon::parse($request->get('start_date'));
        // $endDateToCheck = Carbon::parse($request->get('end_date'));
        
        // if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
        //     return back()->withErrors('Truck '.$request->get('main_truck').'allready has a subunit from '.$test44.' to '.$test55);
        // }

        $getId = Truck_subunits::where('main_truck', $request->get('main_truck'))
         ->pluck('trucks_id')
         ->all();
        
        $getStartDatesById = Truck_subunits::where('trucks_id', $getId)
            ->pluck('start_date')
            ->all();

        $getEndDatesById = Truck_subunits::where('trucks_id', $getId)
            ->pluck('end_date')
            ->all();
            // foreach (array_combine($getStartDatesById, $getEndDatesById) as $getStartDateById => $getEndDateById)
//     foreach (array_combine($getStartDatesById, $getEndDatesById) as $getStartDateById => $getEndDateById){
//     dump($getStartDateById, $getEndDateById);
//     die();
//     $startDate = Carbon::parse($getStartDateById);
//     $startDateToCheck = Carbon::parse($request->get('start_date'));

//     $endDate = Carbon::parse($getEndDateById);
//     $endDateToCheck = Carbon::parse($request->get('end_date'));

//     // dump($getStartDateById);
//     // die();
//     if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//         return back()->withErrors('Truck allready has a subunit');
//     }   
// }
// for($i=0, $count = count($getStartDatesById);$i<$count;$i++) {
//     $course  = $getStartDatesById[$i];
//     $section = $getEndDatesById[$i];
//     // dump($course, $section);
//     // die();
//     $startDate = Carbon::parse($course);
//     $startDateToCheck = Carbon::parse($request->get('start_date'));

//     $endDate = Carbon::parse($section);
//     $endDateToCheck = Carbon::parse($request->get('end_date'));

//     // dump($course, $section, $startDate, $endDate);
//     // die();
//     // if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//     //     return back()->withErrors('Truck allready has a subunit');
//     // }  
//    }
//    dump($getStartDatesById, $course, $section);
//    die();
//    for($i = 0; $i < count($getStartDatesById); ++$i) {
//     $getStartDateById  = $getStartDatesById[$i];
//     $startDate = Carbon::parse($getStartDateById);
//     $startDateToCheck = Carbon::parse($request->get('start_date'));
//     for($i = 0; $i < count($getEndDatesById); ++$i) {
//         $getEndDateById = $getEndDatesById[$i];
//         $endDate = Carbon::parse($getEndDateById);
//         $endDateToCheck = Carbon::parse($request->get('end_date'));
//     }  
//    }

//    if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//             return back()->withErrors('Truck allready has a subunit');
//         }
// dump($startDate, $endDate);
// die();
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
//    die();
// var_dump($startDate);
//     die();
// if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//     return back()->withErrors('Truck allready has a subunit');
// }
// dd($getId, $getId11, $getId22);

//         $startDate = Carbon::parse($getId11);
//         $endDate = Carbon::parse($getId22);
//         $startDateToCheck = Carbon::parse($request->get('start_date'));
//         $endDateToCheck = Carbon::parse($request->get('end_date'));
// // dd($startDate, $endDate);
//         if (($startDateToCheck < $startDate) || ($endDateToCheck > $endDate)) {
//             return back()->withErrors('Truck allready has a subunit');
//         }

//         if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//             return back()->withErrors('Truck '.$request->get('main_truck').'allready has a subunit from '.$getId11.' to '.$getId22);
//         }

        // if (($request->get('start_date') < $test44 && $request->get('end_date') > $test55) || ($request->get('start_date') > $test55 && $request->get('end_date') < $test44)) {
        //     echo 'ok';
        //   } else {
        //     echo 'not ok';
        //   }
// die();
        // if ($test22 == $test33) {
        //     return back()->withErrors('This truck allready has a subunit!');
        // } 
        // dd($request->get('main_truck'));

        // $truck = Trucks::find($request->get('main_truck'));
        // // $trucksub = Truck_subunits::find($truck);
        // dd($truck);
        // dd($trucksub);
                // $subunit = new Truck_subunits;
                // $subunit->trucks_id = $truck->id;
                // $subunit->main_truck = 'a4687';
                // $subunit->subunit = 'test';
                // $subunit->start_date = '2023-06-06';
                // $subunit->end_date = '2023-07-10';
                // $subunit->save();

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
       
        $newSubunit = Truck_subunits::create([
            'trucks_id' => $truck,
            'main_truck' => $request->main_truck,
            'subunit' => $request->subunit,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
       
        // $newPost = BlogPost::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'user_id' => 1
        // ]);

        // $data['trucks_id'] = $truck;
        // $subunit->save();
        // $newSubunit = Truck_subunits::create(array(
        //     'trucks_id' => 1
        // ));
//  dd($newSubunit);
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

// $test22 = Truck_subunits::where('main_truck', $request->get('main_truck'))->get('trucks_id');
$getId = Truck_subunits::where('main_truck', $request->get('main_truck'))
         ->pluck('trucks_id')
         ->all();
        
// $trucksDate = []; 
// foreach ($test22 as $p) {
//     $test111 = $p->trucks_id;
//     $trucksDate[] = $test111;
// //     echo " $test111 <br>";
// // var_dump($test111);
//     $test44 = Truck_subunits::where('trucks_id', $test111)->value('start_date');
//     $test55 = Truck_subunits::where('trucks_id', $test111)->value('end_date');

//     $startDate = Carbon::parse($test44);
//     $endDate = Carbon::parse($test55);
//     $startDateToCheck = Carbon::parse($request->get('start_date'));
//     $endDateToCheck = Carbon::parse($request->get('end_date'));

//     dd( $test111, $trucksDate, $test44, $test55);
    
//     if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
//         return back()->withErrors('Truck '.$request->get('main_truck').'allready has a subunit from '.$test44.' to '.$test55);
//     }
//     }
//     $products = []; 
//    foreach(session('products') as $session){
//       $post=Post::find($session->id);
//       $trucksDate[] = $post;
//    }
    // die();
        // dd($test22, $getId);

        // $test44 = Truck_subunits::where('trucks_id', $getId)->value('start_date');
        $getId11 = Truck_subunits::where('trucks_id', $getId)
            ->orderBy('start_date', 'ASC')
            ->pluck('start_date')
            ->first();
        // $test55 = Truck_subunits::where('trucks_id', $getId)->value('end_date');
        $getId22 = Truck_subunits::where('trucks_id', $getId)
            ->orderBy('end_date', 'DESC')
            ->pluck('end_date')
            ->first();
        // $getId11Implode = implode(" ",$getId11);
        // $getId22Implode = implode(" ",$getId22);
        // dd($getId11, $getId22);
        // $trucksDate = [];
        // foreach ($getId11 as $p) {
        //     // $trucksDate[] = $p;
        //     //     $trucksDate[] = $test111;
        //     //     echo " $test111 <br>";
        //     // var_dump($test111);
        //         // $test44 = Truck_subunits::where('trucks_id', $p)->value('start_date');
        //         // $test55 = Truck_subunits::where('trucks_id', $test111)->value('end_date');
            
        //         $startDate = Carbon::parse($p);
        //         // $endDate = Carbon::parse($test55);
        //         $startDateToCheck = Carbon::parse($request->get('start_date'));
        //         // $endDateToCheck = Carbon::parse($request->get('end_date'));
        //         foreach ($getId22 as $p1) {
    
        //                 // $startDate = Carbon::parse($p);
        //                 $endDate = Carbon::parse($p1);
        //                 // $startDateToCheck = Carbon::parse($request->get('start_date'));
        //                 $endDateToCheck = Carbon::parse($request->get('end_date'));
    
        //                 }
        //                 if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
        //                     return back()->withErrors('Truck allready has a subunit');
        //                 }
            
        //         // dd($startDateToCheck);
        // //         $startDate = Carbon::parse($trucksDate);
        // // $endDate = Carbon::parse($getId22);
        //         }
        //         dd($startDateToCheck);
        // //         dd($trucksDate, $getId11, $p);
        //         die();
        $startDate = Carbon::parse($getId11);
        $endDate = Carbon::parse($getId22);
        $startDateToCheck = Carbon::parse($request->get('start_date'));
        $endDateToCheck = Carbon::parse($request->get('end_date'));

        // // dd($test22, $test44, $test55, $startDate, $endDate, $startDateToCheck, $endDateToCheck);
        // dd($getId, $getId11, $getId22, $getId11Implode, $getId22Implode, $startDate, $endDate);
        if (($startDateToCheck < $startDate) || ($endDateToCheck > $endDate)) {
            return back()->withErrors('Truck allready has a subunit');
        }

        
        if (($startDateToCheck->between($startDate, $endDate)) && ($endDateToCheck->between($startDate, $endDate))) {
            return back()->withErrors('Truck '.$request->get('main_truck').'allready has a subunit from '.$getId11.' to '.$getId22);
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