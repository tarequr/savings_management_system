<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-indigo-800 leading-tight">
                {{ __('Savings Records') }}
            </h2>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('savings.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                Add Deposit
            </a>
            @endif
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
                                <th class="px-6 py-4 font-medium">Month/Year</th>
                                <th class="px-6 py-4 font-medium">Amount</th>
                                <th class="px-6 py-4 font-medium">Date</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($savings as $saving)
                            <tr class="hover:bg-gray-50 transition-colors">
                                @if(Auth::user()->isAdmin())
                                <td class="px-6 py-4 text-gray-800 font-bold capitalize">{{ $saving->user->name }}</td>
                                @endif
                                <td class="px-6 py-4 text-gray-600">{{ $saving->month }} {{ $saving->year }}</td>
                                <td class="px-6 py-4 text-indigo-600 font-bold">৳{{ number_format($saving->amount) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $saving->payment_date ? date('d M, Y', strtotime($saving->payment_date)) : 'N/A' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full font-bold {{ $saving->status == 'paid' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                                        {{ strtoupper($saving->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $savings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
