@extends('layouts.app')

@push('styles')
@endpush

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Members Manage</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="float-end">
                            @if (Auth::user()->isAdmin())
                            <a href="{{ route('members.create') }}" class="btn-shadow btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Create
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
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Total Deposit</th>
                                            <th class="text-center">Total Loan</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Joined At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach($members as $key => $member)
                                            <tr>
                                                <td class="text-center text-muted" data-order="{{ $key + 1 }}">#{{ $key + 1 }}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <div class="widget-content-left">
                                                                    <img  width="40" class="rounded-circle"
                                                                    src="{{ $member->photo != null ? asset('upload/members/'.$member->photo) : asset('assets/images/placeholder.png') }}" alt="{{ $member->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="widget-content-left flex2">
                                                                <div class="widget-heading">{{ $member->name }}</div>
                                                                <div class="widget-subheading opacity-7">
                                                                    <span class="badge bg-info">{{ ucfirst($member->role) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $member->phone }}</td>
                                                <td class="text-center fw-bold text-success">{{ number_format($member->savings_sum_amount ?? 0) }}</td>
                                                <td class="text-center fw-bold text-danger">{{ number_format($member->loans_sum_amount ?? 0) }}</td>
                                                
                                                @php
                                                    $balance = ($member->savings_sum_amount ?? 0) - ($member->loans_sum_amount ?? 0);
                                                @endphp
                                                <td class="text-center fw-bold {{ $balance >= 0 ? 'text-primary' : 'text-danger' }}">
                                                    {{ number_format($balance) }}
                                                </td>

                                                <td class="text-center">
                                                    @if($member->status == true)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $member->created_at->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    
                                                            <a href="{{ route('members.show',$member->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                                                <i class="fa fa-eye"></i>
                                                                <span>Show</span>
                                                            </a>

                                                            <a href="{{ route('members.edit',$member->id) }}" class="btn btn-success btn-sm" title="Edit">
                                                                <i class="fa fa-edit"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            
                                                            <button type="button" onclick="deleteData({{ $member->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="fa fa-trash-alt"></i>
                                                                <span>Delete</span>
                                                            </button>

                                                    <form id="delete-form-{{ $member->id }}" method="POST" action="{{ route('members.destroy',$member->id) }}" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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

@push('scripts')
<script>
    
</script>
@endpush
