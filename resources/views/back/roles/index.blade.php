@extends('back.master')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Roles Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Guard</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (isset($roles) && count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $loop->iteration + ($roles->firstItem() - 1) }}</strong>
                                    <!-- Replace with the actual iteration number if needed -->
                                </td>
                                <td>{{ $role->name }}</td> <!-- Replace with actual admin name -->
                                <td>{{ $role->guard_name }}</td> <!-- Replace with actual admin email -->
                                <!-- Replace with actual role -->
                                <td>
                                    <!-- Assuming this admin is not a Super Admin -->
                                    <div class="d-flex align-items-center">
                                        <!-- Show Button -->
                                        <a href="{{ route('back.role.show', ['role' => $role]) }}"
                                            class="btn btn-sm btn-success me-2">
                                            Show
                                        </a>
                                        <!-- Edit Button -->
                                        <a href="#" class="btn btn-sm btn-warning me-2">
                                            Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="#" method="post">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input class="btn btn-sm btn-danger me-2" type="submit" value="Delete">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <h1>no</h1>
                    @endif
                </tbody>
            </table>
            <div class="container mt-4">
                {{ $roles->links('pagination::bootstrap-5') }}

            </div>

        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
