@extends('layouts.app')

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Savings Management</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="float-end">
                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('savings.create') }}" class="btn btn-primary btn-sm btn-shadow">
                                <i class="fa fa-plus-circle"></i> Add Saving
                            </a>
                            @endif
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
                                            <th class="text-center">Month/Year</th>
                                            <th class="text-center">Payment Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($savings as $key => $saving)
                                            <tr>
                                                <td class="text-center text-muted" data-order="{{ $key + 1 }}">#{{ $key + 1 }}</td>
                                                <td>
                                                    <a href="{{ route('members.show', $saving->user_id) }}" class="text-dark fw-bold">
                                                        {{ $saving->user->name ?? 'N/A' }}
                                                    </a>
                                                    <br>
                                                    <small class="text-muted">{{ $saving->user->member_id ?? '' }}</small>
                                                </td>
                                                <td>{{ number_format($saving->amount, 2) }}</td>
                                                <td>{{ $saving->month }} - {{ $saving->year }}</td>
                                                <td>{{ \Carbon\Carbon::parse($saving->payment_date)->format('d M, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-success">Paid</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('savings.show', $saving->id) }}" class="btn btn-primary btn-sm" title="Show">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    @if (Auth::user()->isAdmin())
                                                        <a href="{{ route('savings.edit', $saving->id) }}" class="btn btn-success btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                        <button type="button" onclick="deleteData({{ $saving->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>

                                                        <form id="delete-form-{{ $saving->id }}" method="POST" action="{{ route('savings.destroy', $saving->id) }}" style="display: none;">
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
