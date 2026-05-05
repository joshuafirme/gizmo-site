
@extends('admin.layouts.app')

@section('panel')

    <!-- Dashboard Content Area (Yield in Laravel) -->
    <div class="container-fluid p-4">
        <h4 class="mb-4">System Overview</h4>
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="admin-card border-top border-primary border-3">
                    <h6 class="text-muted">Total Products</h6>
                    <h3>124</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="admin-card border-top border-success border-3">
                    <h6 class="text-muted">Active Reviews</h6>
                    <h3>48</h3>
                </div>
            </div>
        </div>

        <!-- Example Table -->
        <div class="admin-card">
            <h5 class="mb-4">Recent Products</h5>
            <table class="table table-dark table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>GizmoRack Pro V3</td>
                        <td>Data Center</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td><button class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-pen"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection