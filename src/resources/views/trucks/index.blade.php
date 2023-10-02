@extends('layouts.app')

@section('content')
<div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{session('success')}}</strong>
    </div>
    @endif
</div>
<h1>Trucks</h1>
    
    <div>
        <a href="{{route('trucks.create')}}">Create a truck</a>
    </div>
    <div>
        <a href="{{route('trucks.assignsubunits')}}">Create a Subunit</a>
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
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Trucks</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{route('trucks.create')}}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Truck</span></a>
                        <form method="post" action="{{route('trucks.delete', ['trucks' => $truck] )}}">
                            @csrf
                            @method('delete')
                            <button type="submit" value="Delete" class="btn btn-danger"><i class="material-icons" title="Delete">&#xE15C;</i> <span>Delete</span></button>
                        </form>				
					</div>
				</div>
			</div>
            <div class="bd-example">
                <div class="overflow-auto" style="max-height: 300px;">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>ID</th>
                            <th>Unit number</th>
                            <th>Year</th>
                            <th>Notes</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($trucks as $truck)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td>{{$truck->id}}</td>
                                <td>{{$truck->unit_number}}</td>
                                <td>{{$truck->year}}</td>
                                <td>{{$truck->notes}}</td>
                                <td>{{$truck->created_at}}</td>
                                <td>{{$truck->updated_at}}</td>
                                <td>
                                    <a href="{{route('trucks.edit', ['trucks' => $truck])}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <form method="post" action="{{route('trucks.delete', ['trucks' => $truck] )}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" value="Delete" class="border-0" class="btn btn-danger"><i class="material-icons" title="Delete">&#xE872;</i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix">
            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
            <ul class="pagination">
                <li class="page-item disabled"><a href="#">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container-x2">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Subunits</h2>
					</div>
					<div class="col-sm-6">
						<a href="{{route('trucks.assignsubunits')}}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Subunit</span></a>
                        <form method="post" action="{{route('trucks.deletesubunit', ['subunits' => $subunit])}}">
                            @csrf
                            @method('delete')
                            <button type="submit" value="Delete" class="btn btn-danger"><i class="material-icons" title="Delete">&#xE15C;</i> <span>Delete</span></button>
                        </form>				
					</div>
				</div>
			</div>
            <div class="bd-example">
                <div class="overflow-auto" style="max-height: 300px;">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="selectAll">
                                    <label for="selectAll"></label>
                                </span>
                            </th>
                            <th>ID</th>
                            <th>truck_id</th>
                            <th>Main truck</th>
                            <th>Subunit</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($subunits as $subunit)
                            <tr>
                                <td>
                                    <span class="custom-checkbox">
                                        <input type="checkbox" id="checkbox1" name="options[]" value="1">
                                        <label for="checkbox1"></label>
                                    </span>
                                </td>
                                <td>{{$subunit->id}}</td>
                                <td>{{$subunit->trucks_id}}</td>
                                <td>{{$subunit->main_truck}}</td>
                                <td>{{$subunit->subunit}}</td>
                                <td>{{$subunit->start_date}}</td>
                                <td>{{$subunit->end_date}}</td>
                                <td>
                                    <a href="{{route('trucks.editsubunit', ['subunits' => $subunit])}}" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                                    <form method="post" action="{{route('trucks.deletesubunit', ['subunits' => $subunit])}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" value="Delete" class="border-0" class="btn btn-danger"><i class="material-icons" title="Delete">&#xE872;</i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix">
            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
            <ul class="pagination">
                <li class="page-item disabled"><a href="#">Previous</a></li>
                <li class="page-item"><a href="#" class="page-link">1</a></li>
                <li class="page-item"><a href="#" class="page-link">2</a></li>
                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                <li class="page-item"><a href="#" class="page-link">4</a></li>
                <li class="page-item"><a href="#" class="page-link">5</a></li>
                <li class="page-item"><a href="#" class="page-link">Next</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection