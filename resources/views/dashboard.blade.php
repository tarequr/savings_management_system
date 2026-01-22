<x-app-layout>
    <x-slot name="header">
        {{ Auth::user()->isAdmin() ? 'Administration Dashboard' : 'Member Account Overview' }}
    </x-slot>

    <div class="row g-4 mb-5">
        @if(Auth::user()->isAdmin())
            <!-- Admin Stats Cards -->
            <div class="col-xl-3 col-md-6">
                <div class="card status-card border-start-0 border-end-0 border-top-0 border-4 border-primary">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="small fw-bold text-muted text-uppercase mb-1">Total Active Members</p>
                                <h2 class="fw-bold mb-0">{{ $total_members }}</h2>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                                    <i class="fas fa-users fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card status-card border-start-0 border-end-0 border-top-0 border-4 border-success">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="small fw-bold text-muted text-uppercase mb-1">Cumulative Savings</p>
                                <h2 class="fw-bold mb-0">৳{{ number_format($total_savings) }}</h2>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <div class="bg-success bg-opacity-10 text-success rounded p-3">
                                    <i class="fas fa-piggy-bank fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card status-card border-start-0 border-end-0 border-top-0 border-4 border-warning">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="small fw-bold text-muted text-uppercase mb-1">Outstanding Loans</p>
                                <h2 class="fw-bold mb-0">৳{{ number_format($total_loans) }}</h2>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <div class="bg-warning bg-opacity-10 text-warning rounded p-3">
                                    <i class="fas fa-hand-holding-usd fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card status-card border-start-0 border-end-0 border-top-0 border-4 border-info">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <p class="small fw-bold text-muted text-uppercase mb-1">Loan Applications</p>
                                <h2 class="fw-bold mb-0">{{ $pending_loans_count }}</h2>
                            </div>
                            <div class="flex-shrink-0 ms-3">
                                <div class="bg-info bg-opacity-10 text-info rounded p-3">
                                    <i class="fas fa-file-invoice-dollar fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members Data Table -->
            <div class="col-12 mt-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                        <h6 class="card-title h6">Recently Registered Members</h6>
                        <a href="{{ route('members.index') }}" class="btn btn-primary btn-sm btn-action">Manage All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background: #fcfdfe;">
                                    <tr>
                                        <th class="ps-4 py-3 text-muted small fw-bold">NAME</th>
                                        <th class="py-3 text-muted small fw-bold text-center">EMAIL</th>
                                        <th class="py-3 text-muted small fw-bold text-center">PHONE</th>
                                        <th class="py-3 text-muted small fw-bold text-center">JOINING DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $member)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded p-2 me-3 d-none d-sm-block">
                                                    <i class="fas fa-user-circle text-muted"></i>
                                                </div>
                                                <span class="fw-semibold text-dark">{{ $member->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 text-center text-muted small">{{ $member->email }}</td>
                                        <td class="py-3 text-center">
                                            <span class="badge bg-light text-dark fw-normal border opacity-75">{{ $member->phone ?? 'N/A' }}</span>
                                        </td>
                                        <td class="py-3 text-center text-muted small">{{ $member->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- Member Account Summary -->
            <div class="col-md-6 text-center">
                <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
                    <p class="small fw-bold text-muted text-uppercase mb-2">My Total Savings Balance</p>
                    <h1 class="display-6 fw-bold text-primary mb-3">৳{{ number_format($my_total_savings) }}</h1>
                    <div class="mt-2">
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 border border-success border-opacity-25 rounded-pill fw-normal">Verified Portfolio</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 text-center">
                <div class="card border-0 shadow-sm p-4 h-100 d-flex flex-column justify-content-center">
                    <p class="small fw-bold text-muted text-uppercase mb-2">Current Active Loans</p>
                    <h1 class="display-6 fw-bold text-warning mb-3">৳{{ number_format($my_total_loans) }}</h1>
                    <div class="mt-2">
                        <a href="{{ route('loans.index') }}" class="btn btn-link text-warning text-decoration-none small fw-bold">View Loan Schedule →</a>
                    </div>
                </div>
            </div>

            <!-- Detailed History -->
            <div class="col-lg-7 mt-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header border-bottom-0 d-flex justify-content-between align-items-center">
                        <h6 class="card-title">Recent Savings Contributions</h6>
                        <span class="badge bg-primary bg-opacity-10 text-primary fw-normal">Account Activity</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @forelse($my_savings as $saving)
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-0 border-bottom mx-4 px-0">
                                <div>
                                    <p class="mb-0 fw-bold">{{ $saving->month }} {{ $saving->year }}</p>
                                    <p class="mb-0 text-muted extra-small">Paid on {{ $saving->payment_date ? $saving->payment_date->format('M d, Y') : 'Processing' }}</p>
                                </div>
                                <div class="text-end">
                                    <p class="mb-0 fw-bold text-dark">৳{{ number_format($saving->amount) }}</p>
                                    <span class="extra-small fw-bold text-uppercase {{ $saving->status == 'paid' ? 'text-success' : 'text-warning' }}">
                                        {{ $saving->status }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="py-5 text-center text-muted small">No recent savings transactions found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mt-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header border-bottom-0">
                        <h6 class="card-title">Pending Loan Requests</h6>
                    </div>
                    <div class="card-body">
                        @forelse($my_loans as $loan)
                        <div class="d-flex align-items-center p-3 mb-3 bg-light rounded-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-file-invoice-dollar fa-2x text-warning opacity-50"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="small fw-bold mb-0">৳{{ number_format($loan->amount) }}</p>
                                <p class="text-muted extra-small mb-0">Requested {{ $loan->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0 ms-auto">
                                <span class="badge rounded-pill fw-normal shadow-sm
                                    @if($loan->status == 'approved' || $loan->status == 'disbursed') bg-success 
                                    @elseif($loan->status == 'pending') bg-info text-white 
                                    @else bg-danger @endif px-3 py-2">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="h-100 d-flex flex-column justify-content-center align-items-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-light mb-3"></i>
                            <p class="text-muted small">No pending loan applications found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .extra-small { font-size: 0.725rem; }
        .list-group-item:last-child { border-bottom: none !important; }
        .status-card { transition: transform 0.2s; }
        .status-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
</x-app-layout>
