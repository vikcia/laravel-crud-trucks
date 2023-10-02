@extends('layouts.app')

@section('content')
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
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm">
						<h2>Edit a truck</h2>
					</div>
					<div class="col-sm">
						<a href="{{route('trucks.index')}}" class="btn btn-success">
                            <span>Back to Home page</span></a>			
					</div>
				</div>
			</div>
            <form method="post" action="{{route('trucks.updatesubunit', ['subunits' => $subunits, 'trucks' => $trucks])}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Main truck</label>
                    <input name="main_truck" class="form-control" value="{{$subunits->main_truck}}" readonly/>
                </div>
                <div class="form-group">
                    <label>Change subunit {{$subunits->subunit}} to</label>
                    <select name="subunit" class="form-control">
                        @foreach($trucks as $truck)
                        <option value="{{$truck->unit_number}}">{{$truck->unit_number}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Start date</label>
                    <input type="text" class="form-control" name="start_date" placeholder="Start date" value="{{$subunits->start_date}}" />
                </div>
                <div class="form-group">
                    <label>End date</label>
                    <input type="text" class="form-control" name="end_date" placeholder="end_date" value="{{$subunits->end_date}}" />
                </div>
                <button type="submit" class="btn btn-primary">Update a Subunit</button>
            </form>
        </div>
    </div>
</div>
@endsection