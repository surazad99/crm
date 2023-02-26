@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="route('companies.index')">Companies</a></li>
    <li class="breadcrumb-item active"> {{ $company->name }}</li>
    <li class="breadcrumb-item active"><a href= "{{ route('companies.employees.index', $company)}}">Employees</a> </li>
    <li class="breadcrumb-item active">list</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Employees of {{ $company->name }}</h3>
            <div class="card-tools">
                <a href="{{ route('companies.employees.create', $company) }}" class="btn btn-success">Create</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                           
                            <td>{{  $employee->company->name }}</td>
                            <td>{{  $employee->email }}</td>
                            <td>{{  $employee->phone_number }}</td>
                            <td>
                                <a href="{{ route('companies.employees.show', [$company, $employee]) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('companies.employees.edit', [$company, $employee]) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal{{ $employee->id }}">Delete</button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $employee->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $employee->id }}">Delete
                                                    Employee</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete {{ $employee->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('companies.employees.destroy', [$company, $employee]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $employees->links() }}
        </div>
    </div>
    <!-- /.card -->
@endsection
