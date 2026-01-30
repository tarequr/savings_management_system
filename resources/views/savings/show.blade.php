@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Saving Invoice #{{ $saving->id }}</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="float-end">
                            <a href="{{ route('savings.index') }}" class="btn btn-sm btn-secondary">
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
                                <h4 class="float-end font-size-16">Invoice #{{ str_pad($saving->id, 5, '0', STR_PAD_LEFT) }}</h4>
                                <div class="mb-4">
                                    <h5 class="font-size-16">Member Details</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        {{ $saving->user->name }}<br>
                                        {{ $saving->user->email }}<br>
                                        Member ID: {{ $saving->user->member_id ?? 'N/A' }}
                                    </address>
                                </div>
                                <div class="col-6 text-end">
                                    <address>
                                        <strong>Payment Date:</strong><br>
                                        {{ \Carbon\Carbon::parse($saving->payment_date)->format('F d, Y') }}<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        Cash/Bank Transfer<br>
                                        {{ $saving->user->email }}
                                    </address>
                                </div>
                                <div class="col-6 mt-4 text-end">
                                    <address>
                                        <strong>Status:</strong><br>
                                        <span class="badge bg-success">Paid</span>
                                    </address>
                                </div>
                            </div>
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 fw-bold">Order Summary</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th class="text-end">Year</th>
                                            <th class="text-end">Month</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Monthly Saving Deposit</td>
                                            <td class="text-end">{{ $saving->year }}</td>
                                            <td class="text-end">{{ $saving->month }}</td>
                                            <td class="text-end">{{ number_format($saving->amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end"><strong>Total</strong></td>
                                            <td class="text-end"><strong>{{ number_format($saving->amount, 2) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i> Print</a>
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('savings.edit', $saving->id) }}" class="btn btn-primary w-md waves-effect waves-light">Edit</a>
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
