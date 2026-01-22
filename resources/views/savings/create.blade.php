<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight">
            {{ __('Add Saving Deposit') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form method="POST" action="{{ route('savings.store') }}" class="space-y-6">
                    @csrf

                    <!-- Member Selection -->
                    <div>
                        <x-input-label for="user_id" :value="__('Select Member')" />
                        <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" required>
                            <option value="">Select a member</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->email }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Amount -->
                        <div>
                            <x-input-label for="amount" :value="__('Amount (BDT)')" />
                            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" value="2000" required />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div>
                            <x-input-label for="payment_date" :value="__('Payment Date')" />
                            <x-text-input id="payment_date" class="block mt-1 w-full" type="date" name="payment_date" value="{{ date('Y-m-d') }}" required />
                            <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Month -->
                        <div>
                            <x-input-label for="month" :value="__('For Month')" />
                            <select id="month" name="month" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" required>
                                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}" {{ date('F') == $month ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('month')" class="mt-2" />
                        </div>

                        <!-- Year -->
                        <div>
                            <x-input-label for="year" :value="__('For Year')" />
                            <select id="year" name="year" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" required>
                                @for($i = date('Y')-1; $i <= date('Y')+1; $i++)
                                    <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t border-gray-100 pt-6">
                        <a href="{{ route('savings.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4 font-medium">Cancel</a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Save Deposit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
