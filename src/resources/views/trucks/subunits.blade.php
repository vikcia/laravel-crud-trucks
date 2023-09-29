<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Create a Subunit</h1>
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
    <div class="alert alert-danger">
        <ul>
            @foreach( $getStartDatesById as $index => $getStartDateById )
                <li>{{ app('request')->get('main_truck') }} truck allready has a subunit from {{ $getStartDateById }} to {{ $getEndDatesById[$index] }}</li>
            @endforeach
        </ul>
    </div>
    <!-- @if($errors->any())
    <ul>
    @foreach ($errors->all() as $error)
        <li>This truck allready has a subunit from {{ $error }}</li>
    @endforeach
    </ul>
@endif -->
    <!-- @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            @foreach($getStartDatesById as $getStartDateById)
                <li>{{$getStartDateById}}</li>
            @endforeach
        </ul>
    </div>
@endif -->
    
    
    </div>
    <form method="post" action="{{route('trucks.subunits')}}">
        @csrf
        @method('post')
        <div>
            <label>Unit number</label>
            <select name="main_truck">
                    @foreach($trucks as $truck)
                            <option value="{{$truck->unit_number}}">{{$truck->unit_number}}</option>
                    @endforeach
            </select> 
        </div>
        <div>
            <label>Subunit</label>
            <select name="subunit">
                    @foreach($trucks as $truck)
                            <option value="{{$truck->unit_number}}">{{$truck->unit_number}}</option>
                    @endforeach
            </select> 
        </div>
        <div>
            <label>Start date</label>
            <input type="text" name="start_date" placeholder="Start date" />
        </div>
        <div>
            <label>End date</label>
            <input type="text" name="end_date" placeholder="End date" />
        </div>
        <div>
            <input type="submit" value="Save Subunit of a Truck" />
        </div>
    </div>
    </form>
</body>
</html>