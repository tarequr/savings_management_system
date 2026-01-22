<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight">
            {{ Auth::user()->isAdmin() ? __('Admin Dashboard') : __('Member Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            @if(Auth::user()->isAdmin())
            <!-- Admin Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-100 hover:shadow-md transition-shadow">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Members</p>
                    <h3 class="mt-2 text-3xl font-bold text-indigo-600">{{ $total_members }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100 hover:shadow-md transition-shadow">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Savings</p>
                    <h3 class="mt-2 text-3xl font-bold text-green-600">৳{{ number_format($total_savings) }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-100 hover:shadow-md transition-shadow">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Disbursed Loans</p>
                    <h3 class="mt-2 text-3xl font-bold text-blue-600">৳{{ number_format($total_loans) }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-red-100 hover:shadow-md transition-shadow">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pending Loans</p>
                    <h3 class="mt-2 text-3xl font-bold text-red-600">{{ $pending_loans_count }}</h3>
                </div>
            </div>

            <!-- Latest Members -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Latest Members</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                            <tr>
                                <th class="px-6 py-3 font-medium">Name</th>
                                <th class="px-6 py-3 font-medium">Email</th>
                                <th class="px-6 py-3 font-medium">Phone</th>
                                <th class="px-6 py-3 font-medium">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($members as $member)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-800 font-medium">{{ $member->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $member->email }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $member->phone ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $member->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @else
            <!-- Member Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-indigo-100 hover:shadow-md transition-shadow">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">My Total Savings</p>
                    <h3 class="mt-2 text-3xl font-bold text-indigo-600">৳{{ number_format($my_total_savings) }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-100 hover:shadow-md transition-shadow">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">My Active Loans</p>
                    <h3 class="mt-2 text-3xl font-bold text-blue-600">৳{{ number_format($my_total_loans) }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- My Recent Savings -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Savings</h3>
                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full font-semibold uppercase">Latest 5</span>
                    </div>
                    <div class="p-6">
                        @forelse($my_savings as $saving)
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-2 rounded-lg transition-colors">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">{{ $saving->month }} {{ $saving->year }}</p>
                                <p class="text-xs text-gray-500">{{ $saving->payment_date ? $saving->payment_date->format('M d, Y') : 'Pending' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-indigo-600">৳{{ number_format($saving->amount) }}</p>
                                <span class="text-xs {{ $saving->status == 'paid' ? 'text-green-500' : 'text-orange-500' }}">{{ ucfirst($saving->status) }}</span>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-sm text-center py-4">No savings records found.</p>
                        @endforelse
                    </div>
                </div>

                <!-- My Recent Loans -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Loan Requests</h3>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-semibold uppercase">Latest 5</span>
                    </div>
                    <div class="p-6">
                        @forelse($my_loans as $loan)
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0 hover:bg-gray-50 px-2 rounded-lg transition-colors">
                            <div>
                                <p class="text-sm font-semibold text-gray-800">৳{{ number_format($loan->amount) }}</p>
                                <p class="text-xs text-gray-500">Requested on {{ $loan->created_at->format('M d, Y') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 text-xs rounded-full font-semibold 
                                    @if($loan->status == 'approved' || $loan->status == 'disbursed' || $loan->status == 'completed') bg-green-100 text-green-700 
                                    @elseif($loan->status == 'pending') bg-yellow-100 text-yellow-700 
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($loan->status) }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-sm text-center py-4">No loan requests found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
