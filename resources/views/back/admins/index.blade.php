@extends('back.master')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Admins Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (isset($roles) && isset($admins))
                        @if (count($admins) > 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>
                                            {{ $loop->iteration }}
                                        </strong>
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>
                                        {{ $admin->email }}
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{ $admin->getRoleNames()[0] }}</span></td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-warning">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-danger">No data available</td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
