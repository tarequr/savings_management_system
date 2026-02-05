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
                            <a href="{{ route('reports.savings.pdf', request()->all()) }}" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> Download PDF</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <form action="{{ route('reports.savings') }}" method="GET" class="row mb-4">
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label class="form-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-3 mb-2">
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
                                <div class="col-md-3 mb-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter"></i> Filter</button>
                                    <a href="{{ route('reports.savings') }}" class="btn btn-secondary ms-2 w-100">Reset</a>
                                </div>
                            </form>

                            <div class="alert alert-info d-flex justify-content-between align-items-center mb-4">
                                <h5 class="mb-0">Summary</h5>
                                <div class="fw-bold">Total Savings: <span class="badge bg-primary fs-6">{{ number_format($totalAmount) }}</span></div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="text-center">#SL</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Member ID</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Month/Year</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($savings as $key => $saving)
                                            <tr>
                                                <td class="text-center">{{ $savings->firstItem() + $key }}</td>
                                                <td class="text-center">{{ $saving->payment_date ? $saving->payment_date->format('d M, Y') : 'N/A' }}</td>
                                                <td class="text-center fw-bold text-primary">{{ $saving->user->member_id ?? 'N/A' }}</td>
                                                <td>{{ $saving->user->name ?? 'N/A' }}</td>
                                                <td class="text-center">{{ $saving->month }} {{ $saving->year }}</td>
                                                <td class="text-center fw-bold text-success">{{ number_format($saving->amount) }}</td>
                                                <td>{{ $saving->remarks ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No reports found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                {{ $savings->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
