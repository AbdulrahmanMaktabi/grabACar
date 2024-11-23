@extends('back.master')

@section('content')
    <div class="card">
        <h5 class="card-header">Grabacar API Documentation</h5>
        <div class="card-body">
            <p>Comprehensive guide to managing cars, roles, permissions, and authentication in Grabacar.</p>

            <!-- Car Routes -->
            <section class="mb-4">
                <h6 class="section-title">Car Routes</h6>
                <p>Manage car-related operations including viewing, creating, updating, and deleting car records.</p>

                <h6>Public Endpoints</h6>
                <ul>
                    <li>
                        <code>GET /api/cars/</code> - Fetch all cars in the system.
                    </li>
                    <li>
                        <code>GET /api/cars/show/{carID}</code> - Retrieve details of a specific car by its ID.
                    </li>
                    <li>
                        <code>GET /api/cars/user/{userID}</code> - Fetch all cars belonging to a specific user by their user
                        ID.
                    </li>
                </ul>

                <h6>Protected Endpoints</h6>
                <ul>
                    <li>
                        <code>POST /api/cars/create</code> - Add a new car to the system.
                    </li>
                    <li>
                        <code>POST /api/cars/edit/{carID}</code> - Update details of a specific car.
                    </li>
                    <li>
                        <code>DELETE /api/cars/delete/{carID}</code> - Soft delete a specific car.
                    </li>
                    <li>
                        <code>DELETE /api/cars/delete/force/{carID}</code> - Permanently delete a specific car.
                    </li>
                </ul>
            </section>

            <!-- Role Routes -->
            <section class="mb-4">
                <h6 class="section-title">Role Routes</h6>
                <p>Manage roles within the system.</p>
                <ul>
                    <li>
                        <code>GET /api/roles/</code> - Retrieve a list of all roles.
                    </li>
                </ul>
            </section>

            <!-- Permission Routes -->
            <section class="mb-4">
                <h6 class="section-title">Permission Routes</h6>
                <p>Manage permissions and view permissions based on roles.</p>
                <ul>
                    <li>
                        <code>GET /api/permissions/</code> - Retrieve a list of all permissions.
                    </li>
                    <li>
                        <code>GET /api/permissions/{roleID}</code> - Retrieve permissions associated with a specific role.
                    </li>
                </ul>
            </section>

            <!-- User Authentication Routes -->
            <section class="mb-4">
                <h6 class="section-title">User Authentication Routes</h6>
                <p>Manage user registration, login, and logout.</p>

                <h6>Public Endpoints</h6>
                <ul>
                    <li>
                        <code>POST /api/auth/register</code> - Register a new user.
                    </li>
                    <li>
                        <code>POST /api/auth/login</code> - Log in a user and receive an authentication token.
                    </li>
                </ul>

                <h6>Protected Endpoints</h6>
                <ul>
                    <li>
                        <code>POST /api/auth/logout</code> - Log out the authenticated user.
                    </li>
                </ul>
            </section>

            <!-- Admin Authentication Routes -->
            <section class="mb-4">
                <h6 class="section-title">Admin Authentication Routes</h6>
                <p>Manage admin registration, login, and logout.</p>

                <h6>Public Endpoints</h6>
                <ul>
                    <li>
                        <code>POST /api/admin/auth/register</code> - Register a new admin.
                    </li>
                    <li>
                        <code>POST /api/admin/auth/login</code> - Log in an admin and receive an authentication token.
                    </li>
                </ul>

                <h6>Protected Endpoints</h6>
                <ul>
                    <li>
                        <code>POST /api/admin/auth/logout</code> - Log out the authenticated admin.
                    </li>
                </ul>
            </section>

            <!-- Authentication System -->
            <section class="mb-4">
                <h6 class="section-title">Authentication</h6>
                <p>
                    User and Admin Authentication use the <strong>auth:sanctum</strong> middleware to protect routes.
                    A valid token must be included in the request headers for protected routes.
                </p>
            </section>

            <!-- Key Features -->
            <section class="mb-4">
                <h6 class="section-title">Key Features</h6>
                <ul>
                    <li><strong>Cars Management:</strong> Manage car records (create, update, delete, view).</li>
                    <li><strong>Role-Based Access Control (RBAC):</strong> Manage roles and permissions effectively.</li>
                    <li><strong>Authentication System:</strong> Token-based secure authentication for users and admins.</li>
                </ul>
            </section>
        </div>
    </div>
@endsection
