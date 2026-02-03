@extends('layouts.app')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Member Details</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="float-end">
                            <a href="{{ route('members.index') }}" class="btn btn-primary btn-sm btn-shadow">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 text-center border-end">
                                    <div class="mb-3">
                                        <img src="{{ $member->photo != null ? asset('upload/members/'.$member->photo) : asset('assets/images/placeholder.png') }}" 
                                             alt="{{ $member->name }}" 
                                             class="rounded-circle img-thumbnail" 
                                             style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h4 class="font-size-20 mb-1">{{ $member->name }}</h4>
                                    <p class="text-muted mb-2">{{ $member->email }}</p>
                                    <div class="mb-3">
                                        <span class="badge rounded-pill bg-white border border-primary text-primary px-3 py-2" style="font-size: 0.9rem; letter-spacing: 0.5px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                                            <i class="fa fa-id-card me-1"></i> ID: {{ $member->member_id ?? 'N/A' }}
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-center gap-2 mb-3">
                                        <span class="badge {{ $member->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $member->status ? 'Active' : 'Inactive' }}
                                        </span>
                                        <span class="badge bg-info">{{ ucfirst($member->role) }}</span>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-success btn-block w-100">
                                            <i class="fa fa-edit"></i> Edit Member
                                        </a>
                                    </div>
                                    
                                    <div class="card mt-3 bg-light">
                                        <div class="card-body p-3">
                                            <h6 class="text-muted mb-3 text-center">Financial Summary</h6>
                                            <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                <span>Total Deposit:</span>
                                                <span class="fw-bold text-success">{{ number_format($member->savings_sum_amount ?? 0) }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between border-bottom pb-2 mb-2">
                                                <span>Total Loan:</span>
                                                <span class="fw-bold text-danger">{{ number_format($member->loans_sum_amount ?? 0) }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Balance:</span>
                                                <span class="fw-bold text-primary">{{ number_format(($member->savings_sum_amount ?? 0) - ($member->loans_sum_amount ?? 0)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <h5 class="font-size-16 mb-4 mt-2">Personal Information</h5>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-nowrap table-hover mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" style="width: 200px;">Member ID :</th>
                                                    <td><span class="badge bg-primary">{{ $member->member_id ?? 'N/A' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" style="width: 200px;">Full Name :</th>
                                                    <td>{{ $member->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email Address :</th>
                                                    <td>{{ $member->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Phone Number :</th>
                                                    <td>{{ $member->phone ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Joined Date :</th>
                                                    <td>{{ $member->created_at->format('d M, Y h:i A') }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Last Updated :</th>
                                                    <td>{{ $member->updated_at->diffForHumans() }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <h5 class="font-size-16 mb-3 mt-4">Loan History</h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-0">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Payable</th>
                                                    <th>Paid</th>
                                                    <th>Balance</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($member->loans as $loan)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($loan->disbursed_date ?? $loan->created_at)->format('d M, Y') }}</td>
                                                        <td class="fw-bold">{{ number_format($loan->amount) }}</td>
                                                        <td>{{ number_format($loan->total_payable) }}</td>
                                                        <td class="text-success">{{ number_format($loan->paid_amount) }}</td>
                                                        <td class="text-danger">{{ number_format($loan->total_payable - $loan->paid_amount) }}</td>
                                                        <td>
                                                            @if($loan->status == 'approved' || $loan->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @elseif($loan->status == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @else
                                                                <span class="badge bg-secondary">{{ $loan->status }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-muted">No loan history found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
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
