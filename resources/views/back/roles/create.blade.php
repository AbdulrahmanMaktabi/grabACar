@extends('back.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <h5 class="card-header">Create New Role</h5>
                <hr class="my-0" />

                <div class="card-body">
                    <!-- Role Creation Form -->
                    <form action="{{ route('back.role.store') }}" method="POST">
                        @csrf

                        <!-- Select Guard -->
                        <div class="mb-3">
                            <label for="guardName" class="form-label">Guard</label>
                            <select class="form-select" id="guardName" name="guard_name" onchange="showPermissions()">
                                <option value="">Select Guard</option>
                                <option value="web">Web</option>
                                <option value="admin">Admin</option>
                            </select>
                            <x-input-error :messages="$errors->get('guard_name')" class="mt-2" />
                        </div>

                        <!-- Role Name -->
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" name="role_name"
                                placeholder="Enter role name" value="{{ @old('role_name') }}">
                            <x-input-error :messages="$errors->get('role_name')" class="mt-2" />
                        </div>

                        <!-- Permissions Based on Selected Guard -->
                        <div id="permissionsContainer" style="display: none;">
                            <h5 class="card-header">Permissions</h5>
                            <hr class="my-0" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="permissionsList" class="list-group list-group-flush">
                                        <!-- Permissions will be dynamically inserted here -->
                                        <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary mt-3">Create Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to dynamically show permissions -->
    <script>
        function showPermissions() {
            const guardName = document.getElementById('guardName').value;
            const permissionsContainer = document.getElementById('permissionsContainer');
            const permissionsList = document.getElementById('permissionsList');

            // Clear previous permissions
            permissionsList.innerHTML = '';

            if (guardName === 'web') {
                // Display web permissions
                permissionsContainer.style.display = 'block';
                const webPermissions = [
                    'create_car', 'edit_car', 'delete_car', 'view_cars',
                    'view_dashboard', 'cars_dashboard'
                ];

                webPermissions.forEach(permission => {
                    permissionsList.innerHTML += `<span class="list-group-item">                        
                        <input type="checkbox" id="${permission}" name="permissions[]" value="${permission}">
                        <label for="${permission }">${permission.replace('_', ' ')}</label>
                    </span>`;
                });
            } else if (guardName === 'admin') {
                // Display admin permissions
                permissionsContainer.style.display = 'block';
                const adminPermissions = [
                    'create_user', 'edit_user', 'delete_user', 'view_user', 'assign_role',
                    'edit_admin', 'delete_admin', 'view_admin',
                    'create_role', 'edit_role', 'delete_role', 'view_roles',
                    'assign_permissions', 'edit_permissions', 'view_permissions',
                    'create_car', 'edit_car', 'delete_car', 'view_cars',
                    'view_dashboard', 'users_dashboard', 'admins_dashboard', 'roles_dashboard', 'cars_dashboard'
                ];

                adminPermissions.forEach(permission => {
                    permissionsList.innerHTML += `<span class="list-group-item">
                        <input type="checkbox" id="${permission }" name="permissions[]" value="${permission}">                        
                        <label for="${permission }">${permission.replace('_', ' ')}</label>
                    </span>`;
                });
            } else {
                // Hide the permissions if no guard is selected
                permissionsContainer.style.display = 'none';
            }
        }
    </script>
@endsection
