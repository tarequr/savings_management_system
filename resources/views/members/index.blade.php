<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-indigo-800 leading-tight">
                {{ __('Members Management') }}
            </h2>
            <a href="{{ route('members.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Add New Member
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                            <tr>
                                <th class="px-6 py-4 font-medium">SL</th>
                                <th class="px-6 py-4 font-medium">Name</th>
                                <th class="px-6 py-4 font-medium">Email</th>
                                <th class="px-6 py-4 font-medium">Phone</th>
                                <th class="px-6 py-4 font-medium">Status</th>
                                <th class="px-6 py-4 font-medium">Joined</th>
                                <th class="px-6 py-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 uppercase-first">
                            @foreach($members as $index => $member)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-500 font-mono text-sm">{{ $members->firstItem() + $index }}</td>
                                <td class="px-6 py-4 text-gray-800 font-bold capitalize">{{ $member->name }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $member->email }}</td>
                                <td class="px-6 py-4 text-gray-600 font-mono">{{ $member->phone ?? '---' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full font-bold {{ $member->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        {{ strtoupper($member->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $member->created_at->format('d M, Y') }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Edit</button>
                                    <button class="text-red-500 hover:text-red-700 font-bold text-sm">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 bg-gray-50">
                    {{ $members->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
