@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Loan Details #{{ $loan->id }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="float-end">
                            <a href="{{ route('loans.index') }}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16">
                                    Status: 
                                    @if($loan->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($loan->status == 'approved')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($loan->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @elseif($loan->status == 'paid')
                                        <span class="badge bg-info">Paid</span>
                                    @endif
                                </h4>
                                <div class="mb-4">
                                    <h5 class="font-size-16">Loan #{{ str_pad($loan->id, 5, '0', STR_PAD_LEFT) }}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                        <strong>Applicant:</strong><br>
                                        {{ $loan->user->name }}<br>
                                        {{ $loan->user->email }}<br>
                                        Member ID: {{ $loan->user->member_id ?? 'N/A' }}
                                    </address>
                                </div>
                                <div class="col-6 text-end">
                                    <address>
                                        <strong>Applied Date:</strong><br>
                                        {{ $loan->created_at->format('d M, Y') }}<br>
                                        @if($loan->disbursed_date)
                                            <strong>Disbursed Date:</strong><br>
                                            {{ \Carbon\Carbon::parse($loan->disbursed_date)->format('d M, Y') }}
                                        @endif
                                    </address>
                                </div>
                            </div>

                            <div class="py-2 mt-3">
                                <h5 class="font-size-15">Loan Information</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Requested Amount</th>
                                            <td class="text-end">{{ number_format($loan->amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Interest Rate</th>
                                            <td class="text-end">{{ $loan->interest_rate }}%</td>
                                        </tr>
                                        <tr>
                                            <th>Total Payable</th>
                                            <td class="text-end">{{ number_format($loan->total_payable, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Paid Amount</th>
                                            <td class="text-end">{{ number_format($loan->paid_amount ?? 0, 2) }}</td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th>Remaining Balance</th>
                                            <td class="text-end fw-bold">{{ number_format(($loan->total_payable - ($loan->paid_amount ?? 0)), 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if($loan->description)
                            <div class="mt-4">
                                <strong>Purpose / Description:</strong>
                                <p class="text-muted mt-2">{{ $loan->description }}</p>
                            </div>
                            @endif

                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                                    @if(Auth::user()->isAdmin())
                                        @if($loan->status == 'pending')
                                            <form action="{{ route('loans.approve', $loan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success ms-2" onclick="return confirm('Approve this loan?')">Approve</button>
                                            </form>
                                            <form action="{{ route('loans.reject', $loan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger ms-2" onclick="return confirm('Reject this loan?')">Reject</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-primary ms-2">Edit</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
