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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (isset($roles) && isset($users))
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>
                                            {{ $loop->iteration }}
                                        </strong>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{ $user->getRoleNames()[0] }}</span></td>
                                    <td>
                                        <!-- Button group for Edit and Deactivate -->
                                        <div class="d-flex align-items-center">
                                            @if (isSuperAdmin() || isSameUser('web', $user->id))
                                                <!-- Edit Button -->
                                                <a href="{{ route('back.admin.edit', ['user' => $user]) }}"
                                                    class="btn btn-sm btn-warning me-2">
                                                    Edit
                                                </a>
                                            @endif
                                            {{-- Delete Button --}}
                                            <form action="{{ route('back.admin.destroy', ['user' => $user]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <input class="btn btn-sm btn-danger me-2" type="submit" value="Delete">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <h1>no data</h1>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
