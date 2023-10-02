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
    @if ($getStartDatesById)
    <div class="alert alert-danger">
        <ul>
            @foreach( $getStartDatesById as $index => $getStartDateById )
            <li>{{ app('request')->get('main_truck') }} truck allready has a subunit from {{ $getStartDateById }} to {{ $getEndDatesById[$index] }}</li>
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
						<h2>Create a Subunit</h2>
					</div>
					<div class="col-sm">
						<a href="{{route('trucks.index')}}" class="btn btn-success">
                            <span>Back to Home page</span></a>			
					</div>
				</div>
			</div>
            <form method="post" action="{{route('trucks.assignsubunits')}}">
                @csrf
                @method('post')
                <div class="form-group">
                    <label>Unit number</label>
                    <select name="main_truck" class="form-control">
                        @foreach($trucks as $truck)
                        <option value="{{$truck->unit_number}}">{{$truck->unit_number}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <div>
                        <label>Subunit</label>
                        <select name="subunit" class="form-control">
                            @foreach($trucks as $truck)
                            <option value="{{$truck->unit_number}}">{{$truck->unit_number}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Start date</label>
                    <input type="text" class="form-control" name="start_date" placeholder="Start date">
                </div>
                <div class="form-group">
                    <label>End date</label>
                    <input type="text" class="form-control" name="end_date" placeholder="End date">
                </div>
                <button type="submit" class="btn btn-primary">Save a New Subunit</button>
            </form>
        </div>
    </div>
</div>
@endsection