@extends('admin.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href= "{{route('companies.index') }}">Companies</a></li>
<li class="breadcrumb-item active"> {{ $company->name }}</li>
<li class="breadcrumb-item active"> <a href= "{{ route('companies.employees.index', $company)}}">Employees</a></li>
<li class="breadcrumb-item active">Show</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $employee->name }}</h3>
        <div class="card-tools">
            <a href="{{ route('companies.employees.index', $company) }}" class="btn btn-primary">Back to Employees</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <p><strong>First Name:</strong> {{ $employee->first_name ?? 'N/A' }}</p>
        <p><strong>Last Name:</strong>{{ $employee->last_name ?? 'N/A'  }}</p>
        <p><strong>Company:</strong>{{ $employee->company->name ?? 'N/A'  }}</p>
        <p><strong>Email:</strong>{{ $employee->email ?? 'N/A'  }}</p>
        <p><strong>Phone:</strong>{{ $employee->phone_number ?? 'N/A'  }}</p>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
