@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="route('companies.index')">Companies</a></li>
    <li class="breadcrumb-item active">Show</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $company->name }}</h3>
        <div class="card-tools">
            <a href="{{ route('companies.index') }}" class="btn btn-primary">Back to Companies</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <p><strong>Email:</strong> {{ $company->email ?? 'N/A' }}</p>
        <p><strong>Logo:</strong></p>
        @if ($company->logo)
        <img src="{{ asset(COMPANY_LOGO_URL.'/'.$company->logo) }}" alt="{{ $company->name }}" width="200">
        @else
        N/A
        @endif
        <p><strong>Website:</strong> {{ $company->website ?? 'N/A' }}</p>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
