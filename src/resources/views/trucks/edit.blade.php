<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit a truck</h1>
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
    <form method="post" action="{{route('trucks.update', ['trucks' => $trucks])}}">
        @csrf
        @method('put')
        <div>
            <label>Unit number</label>
            <input type="text" name="unit_number" placeholder="Unit number" value="{{$trucks->unit_number}}" />
        </div>
        <div>
            <label>Year</label>
            <input type="text" name="year" placeholder="Year" value="{{$trucks->year}}" />
        </div>
        <div>
            <label>Notes</label>
            <input type="text" name="notes" placeholder="Notes" value="{{$trucks->notes}}" />
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
</body>
</html>