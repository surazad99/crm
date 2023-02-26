@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="route('companies.index')">Companies</a></li>
    <li class="breadcrumb-item active">List</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Companies</h3>
            <div class="card-tools">
                <a href="{{ route('companies.create') }}" class="btn btn-success">Add Company</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr>
                            <td>{{ $company->name }}</td>
                            <td>{{ $company->email }}</td>
                            <td>
                                @if ($company->logo)
                                    {{-- @dd(asset(COMPANY_LOGO_URL.'/'.$company->logo)); --}}
                                    <img src="{{ asset(COMPANY_LOGO_URL . '/' . $company->logo) }}" alt="{{ $company->name }}"
                                        width="50">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $company->website }}</td>
                            <td>
                                <a href="{{ route('companies.show', $company) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('companies.edit', $company) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#deleteModal{{ $company->id }}">Delete</button>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $company->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $company->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $company->id }}">Delete
                                                    Company</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete {{ $company->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                                <form action="{{ route('companies.destroy', $company) }}" method="POST">
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
            {{ $companies->links() }}
        </div>
    </div>
    <!-- /.card -->
@endsection
