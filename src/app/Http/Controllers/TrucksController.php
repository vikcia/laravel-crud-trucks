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
        
        return redirect(route('trucks.index'))->with('success', 'Truck cteated succesfully');
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
        
        return redirect(route('trucks.index'))->with('success', 'Truck updated succesfully');
    }
    
    public function delete(Trucks $trucks){
        
        $trucks->delete();
        
        return redirect(route('trucks.index'))->with('success', 'Truck deleted succesfully');
    }
}