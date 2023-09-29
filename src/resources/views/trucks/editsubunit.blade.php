<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit a Subunit</h1>
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
    <form method="post" action="{{route('trucks.updatesubunit', ['subunits' => $subunits, 'trucks' => $trucks])}}">
        @csrf
        @method('put')
        <div name="main_truck">
            <!-- Main truck {{$subunits->main_truck}} -->
            <input name="main_truck" value="{{$subunits->main_truck}}" readonly/>
        </div>
        <div>
            <label>Change subunit {{$subunits->subunit}} to</label>
            <select name="subunit">
                @foreach($trucks as $truck)
                    <option value="{{$truck->unit_number}}">{{$truck->unit_number}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Start date</label>
            <input type="text" name="start_date" placeholder="start_date" value="{{$subunits->start_date}}" />
        </div>
        <div>
            <label>End date</label>
            <input type="text" name="end_date" placeholder="end_date" value="{{$subunits->end_date}}" />
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</body>
</html>