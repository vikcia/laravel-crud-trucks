<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Trucks</h1>
    <div>
        @if(session()->has('success'))
            <div>
                {{session('success')}}
            </div>
        @endif
    </div>
    <div>
        <a href="{{route('trucks.create')}}">Create a truck</a>
    </div>
    <div>
        <a href="{{route('trucks.subunits')}}">Create a Subunit</a>
    </div>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Unit number</th>
                <th>Year</th>
                <th>Notes</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($trucks as $truck)
                <tr>
                    <td>{{$truck->id}}</td>
                    <td>{{$truck->unit_number}}</td>
                    <td>{{$truck->year}}</td>
                    <td>{{$truck->notes}}</td>
                    <td>{{$truck->created_at}}</td>
                    <td>{{$truck->updated_at}}</td>
                    <td>
                        <a href="{{route('trucks.edit', ['trucks' => $truck])}}">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{route('trucks.delete', ['trucks' => $truck] )}}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <h2>Subunits</h2>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>truck_id</th>
                <th>Main truck</th>
                <th>Subunit</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($subunits as $subunit)
                <tr>
                    <td>{{$subunit->id}}</td>
                    <td>{{$subunit->trucks_id}}</td>
                    <td>{{$subunit->main_truck}}</td>
                    <td>{{$subunit->subunit}}</td>
                    <td>{{$subunit->start_date}}</td>
                    <td>{{$subunit->end_date}}</td>
                    <td>
                        <a href="{{route('trucks.editsubunit', ['subunits' => $subunit])}}">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="{{route('trucks.deletesubunit', ['subunits' => $subunit])}}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>