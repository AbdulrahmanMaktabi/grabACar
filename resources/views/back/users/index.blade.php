@extends('back.master')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Users Table</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (isset($users) && count($users) > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $loop->iteration + ($users->firstItem() - 1) }}</strong>
                                    <!-- Replace with the actual iteration number if needed -->
                                </td>
                                <td>{{ $user->name }}</td> <!-- Replace with actual admin name -->
                                <td>{{ $user->email }}</td> <!-- Replace with actual admin email -->
                                <td>
                                    @if (count($user->getRoleNames('web')) > 0)
                                        <span class="badge bg-label-primary me-1">
                                            {{ $user->getRoleNames('web')[0] }}
                                        </span>
                                    @else
                                        <span class="badge bg-label-warning me-1">
                                            No Roles
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->hasVerifiedEmail())
                                        <span class="badge bg-label-success me-1">
                                            Verified
                                        </span>
                                    @else
                                        <span class="badge bg-label-danger me-1">

                                            Not Verified
                                        </span>
                                    @endif
                                </td>
                                <!-- Replace with actual role -->
                                <td>
                                    <!-- Assuming this admin is not a Super Admin -->
                                    <div class="d-flex align-items-center">
                                        <!-- Show Button -->
                                        <a href="{{ route('back.user.show', ['user' => $user]) }}"
                                            class="btn btn-sm btn-success me-2">
                                            Show
                                        </a>
                                        <!-- Edit Button -->
                                        <a href="{{ route('back.user.edit', ['user' => $user]) }}"
                                            class="btn btn-sm btn-warning me-2">
                                            Edit
                                        </a>
                                        <!-- Delete Button -->
                                        <form action="{{ route('back.user.destroy', ['user' => $user]) }}" method="post">
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
                {{ $users->links('pagination::bootstrap-5') }}

            </div>

        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
