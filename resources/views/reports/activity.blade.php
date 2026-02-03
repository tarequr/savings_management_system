@extends('layouts.app')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ $pageTitle ?? 'Activity Report' }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-end">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Activity Report</li>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Time</th>
                                            <th class="text-center">User</th>
                                            <th class="text-center">Action</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">IP Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activities as $activity)
                                            <tr>
                                                <td class="text-center">{{ $activity->created_at->format('d M, Y h:i A') }}</td>
                                                <td class="text-center">
                                                    @if($activity->user)
                                                        {{ $activity->user->name }}
                                                        <br>
                                                        <small class="text-muted">{{ $activity->user->role }}</small>
                                                    @else
                                                        <span class="text-muted">System/Deleted User</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ str_replace('_', ' ', strtoupper($activity->action)) }}</span>
                                                </td>
                                                <td>{{ $activity->description }}</td>
                                                <td class="text-center text-muted small">{{ $activity->ip_address }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
@endsection
