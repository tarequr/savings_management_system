@extends('layouts.app')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Loans & Grants Management</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="float-end">
                            <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm btn-shadow">
                                <i class="fa fa-plus-circle"></i> Request Loan
                            </a>
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
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#SL</th>
                                            <th class="text-center">Member Name</th>
                                            <th class="text-center">Amount</th>
                                            <th class="text-center">Total Payable</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Applied Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($loans as $key => $loan)
                                            <tr>
                                                <td class="text-center text-muted" data-order="{{ $key + 1 }}">#{{ $key + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('members.show', $loan->user_id) }}" class="text-dark fw-bold">
                                                        {{ $loan->user->name ?? 'N/A' }}
                                                    </a>
                                                    <br>
                                                    <small class="text-muted">{{ $loan->user->member_id ?? '' }}</small>
                                                </td>
                                                <td>{{ number_format($loan->amount, 2) }}</td>
                                                <td>{{ number_format($loan->total_payable, 2) }}</td>
                                                <td>
                                                    @if($loan->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($loan->status == 'approved')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($loan->status == 'rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @elseif($loan->status == 'paid')
                                                        <span class="badge bg-info">Paid</span>
                                                    @endif
                                                </td>
                                                <td>{{ $loan->created_at->format('d M, Y') }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-primary btn-sm" title="Show">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    @if (Auth::user()->isAdmin())
                                                        @if($loan->status == 'pending')
                                                            <form action="{{ route('loans.approve', $loan->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to approve this loan?')">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('loans.reject', $loan->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject this loan?')">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                        <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-info btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <button type="button" onclick="deleteData({{ $loan->id }})" class="btn btn-secondary btn-sm" title="Delete">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $loan->id }}" method="POST" action="{{ route('loans.destroy', $loan->id) }}" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
