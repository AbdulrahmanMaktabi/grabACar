@extends('back.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">Edit Role</h5>
                <hr class="my-0" />

                <div class="card-body">
                    <!-- Role Creation Form -->
                    <form action="{{ route('back.role.update', ['role' => $role]) }}" method="POST">
                        @csrf
                        @method('put')
                        <!-- Select Guard -->
                        <div class="mb-3">
                            <label for="guardName" class="form-label">Guard</label>
                            <select disabled class="form-select" id="guardName" onchange="showPermissions()">
                                <option value="">Select Guard</option>
                                <option value="web" {{ $role->guard_name === 'web' ? 'selected' : '' }}>Web</option>
                                <option value="admin" {{ $role->guard_name === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('guard_name')" class="mt-2" />

                        </div>

                        <!-- Role Name -->
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" name="role_name"
                                placeholder="Enter role name" value="{{ $role->name }}">
                            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
                        </div>

                        @php
                            use Spatie\Permission\Models\Permission;
                            $permissions = Permission::where('guard_name', $role->guard_name)->get();
                        @endphp
                        @if (count($permissions) > 0)
                            <!-- Permissions Based on Selected Guard -->
                            <div id="permissionsContainer">
                                <h5 class="card-header">Permissions</h5>
                                <hr class="my-0" />
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="permissionsList" class="list-group list-group-flush">
                                            @foreach ($permissions as $permission)
                                                <span class="list-group-item">
                                                    <input type="checkbox" id="{{ $permission->name }}" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        {{ inPermissions($role, $permission) ? 'checked' : '' }}>
                                                    <label for="{{ $permission->name }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </span>
                                            @endforeach
                                            <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
