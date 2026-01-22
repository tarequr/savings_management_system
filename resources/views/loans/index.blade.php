<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-indigo-800 leading-tight">
                {{ __('Loan Applications') }}
            </h2>
            <a href="{{ route('loans.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                Request Loan
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                            <tr>
                                @if(Auth::user()->isAdmin())
                                <th class="px-6 py-4 font-medium">Member</th>
                                @endif
                                <th class="px-6 py-4 font-medium">Amount</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                                <th class="px-6 py-4 font-medium">Requested Date</th>
                                <th class="px-6 py-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($loans as $loan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                @if(Auth::user()->isAdmin())
                                <td class="px-6 py-4 text-gray-800 font-bold capitalize">{{ $loan->user->name }}</td>
                                @endif
                                <td class="px-6 py-4 text-indigo-600 font-bold">৳{{ number_format($loan->amount) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full font-bold 
                                        @if($loan->status == 'approved' || $loan->status == 'disbursed' || $loan->status == 'completed') bg-green-100 text-green-700 
                                        @elseif($loan->status == 'pending') bg-yellow-100 text-yellow-700 
                                        @else bg-red-100 text-red-700 @endif">
                                        {{ strtoupper($loan->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $loan->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-4 text-right flex justify-end space-x-2">
                                    @if(Auth::user()->isAdmin() && $loan->status == 'pending')
                                    <form action="{{ route('loans.approve', $loan) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-xs font-bold transition">Approve</button>
                                    </form>
                                    <form action="{{ route('loans.reject', $loan) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs font-bold transition">Reject</button>
                                    </form>
                                    @endif
                                    <a href="{{ route('loans.show', $loan) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-1 rounded-lg text-xs font-bold transition">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
