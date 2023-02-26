@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="route('companies.index')">Companies</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection


@section('content')
    <h4>Create a Company</h4>
    <form class="form-horizontal" action={{ route('companies.store') }} method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Company Name">
                    @error('name')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Company Email">
                    @error('email')
                    <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>   
            </div>

            <div class="form-group row">
                <label for="logo" class="col-sm-2 col-form-label">Logo <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="logo" name="logo" value="{{ old('logo') }}" placeholder="Password">
                    @error('logo')
                        <span class="error text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            

            <div class="form-group row">
                <label for="website" class="col-sm-2 col-form-label">Website <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}" placeholder="Company Website">
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
@endsection
