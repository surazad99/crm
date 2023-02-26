@extends('admin.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href= "{{route('companies.index') }}">Companies</a></li>
<li class="breadcrumb-item active"> {{ $company->name }}</li>
<li class="breadcrumb-item active"> <a href= "{{ route('companies.employees.index', $company)}}">Employees</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')
    {{-- @dd($employee); --}}
    <h4>Edit an Employee</h4>
    <form class="form-horizontal" action={{ route('companies.employees.update', [$company, $employee]) }} method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" placeholder="First Name">
                    @error('first_name')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" placeholder="First Name">
                    @error('last_name')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" placeholder="Email">
                    @error('email')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>   
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-sm-2 col-form-label">Phone <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="phone" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" placeholder="Phone Number">
                    @error('phone_number')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>   
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
        <!-- /.card-footer -->
    </form>
@endsection
