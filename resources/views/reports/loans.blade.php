@extends('layouts.app')

@push('styles')
<style>
    @media print {
        .side-menu, .topbar, .footer, .btn, .row.mb-4 {
            display: none !important;
        }
        .content-page {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ $pageTitle }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-end">
                            <button onclick="window.print()" class="btn btn-dark btn-sm me-1"><i class="fas fa-print"></i> Print</button>
                            <a href="{{ route('reports.loans.pdf', request()->all()) }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="{{ route('reports.loans') }}" method="GET" class="row mb-4">
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Member</label>
                                    <select name="user_id" class="form-control select2">
                                        <option value="">All Members</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{ request('user_id') == $member->id ? 'selected' : '' }}>
                                                {{ $member->member_id }} - {{ $member->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">All Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <div class="col-md-2 mb-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Filter</button>
                                    <a href="{{ route('reports.loans') }}" class="btn btn-secondary ms-2 w-100">Reset</a>
                                </div>
                            </form>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="alert alert-info mb-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Total Disbursed</h6>
                                            <span class="badge bg-primary fs-6">{{ number_format($totalLoans) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-success mb-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">Total Repaid</h6>
                                            <span class="badge bg-success fs-6">{{ number_format($totalPaid) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">#SL</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Member ID</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Payable</th>
                                            <th class="text-center">Repaid</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($loans as $key => $loan)
                                            <tr>
                                                <td class="text-center">{{ $loans->firstItem() + $key }}</td>
                                                <td class="text-center">{{ $loan->disbursed_date ? $loan->disbursed_date->format('d M, Y') : 'N/A' }}</td>
                                                <td class="text-center fw-bold text-primary">{{ $loan->user->member_id ?? 'N/A' }}</td>
                                                <td>{{ $loan->user->name ?? 'N/A' }}</td>
                                                <td class="text-center fw-bold text-danger">{{ number_format($loan->amount) }}</td>
                                                <td class="text-center">{{ number_format($loan->total_payable) }}</td>
                                                <td class="text-center text-success fw-bold">{{ number_format($loan->paid_amount) }}</td>
                                                <td class="text-center">
                                                    @if($loan->status == 'approved')
                                                        <span class="badge bg-success">Approved</span>
                                                    @elseif($loan->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ ucfirst($loan->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No reports found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $loans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
