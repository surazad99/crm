@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="route('companies.index')">Companies</a></li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Company</h3>
            <div class="card-tools">
                <a href="{{ route('companies.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form class="form-horizontal" action={{ route('companies.update', $company) }} method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $company->name) }}" placeholder="Company Name">
                            @error('name')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
        
                    </div>
        
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $company->email) }}" placeholder="Company Email">
                            @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>   
                    </div>
        
                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Logo <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*" placeholder="Password">
                            @if ($company->logo)
                                <img src="{{ asset(COMPANY_LOGO_URL.'/'.$company->logo) }}" alt="{{ $company->name }} logo" class="img-thumbnail mt-2" width="200">
                            @endif
                            @error('logo')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
        
                    
        
                    <div class="form-group row">
                        <label for="website" class="col-sm-2 col-form-label">Website <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $company->website) }}" placeholder="Company Website">
                            @error('website')
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
        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->
@endsection
