@extends('layouts.app')

@section('content')
<h1>Create a truck</h1>
    <div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    </div>
    <form method="post" action="{{route('trucks.store')}}">
        @csrf
        @method('post')
        <div>
            <label>Unit number</label>
            <input type="text" name="unit_number" placeholder="Unit number" />
        </div>
        <div>
            <label>Year</label>
            <input type="text" name="year" placeholder="Year" />
        </div>
        <div>
            <label>Notes</label>
            <input type="text" name="notes" placeholder="Notes" />
        </div>
        <div>
            <input type="submit" value="Save a New Truck" />
        </div>
    </form>
@endsection