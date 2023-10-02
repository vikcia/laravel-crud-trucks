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
						<h2>Create a truck</h2>
					</div>
					<div class="col-sm">
						<a href="{{route('trucks.index')}}" class="btn btn-success">
                            <span>Back to Home page</span></a>			
					</div>
				</div>
			</div>
            <form method="post" action="{{route('trucks.store')}}">
                @csrf
                @method('post')
                <div class="form-group">
                    <label>Unit number</label>
                    <input type="text" class="form-control" name="unit_number" placeholder="Enter Unit Number">
                </div>
                <div class="form-group">
                    <label>Year</label>
                    <input type="text" class="form-control" name="year" placeholder="Enter Year">
                </div>
                <div class="form-group">
                    <label>Notes</label>
                    <input type="text" class="form-control" name="notes" placeholder="Enter Notes">
                </div>
                <button type="submit" class="btn btn-primary">Save a New Truck</button>
            </form>
        </div>
    </div>
</div>
@endsection