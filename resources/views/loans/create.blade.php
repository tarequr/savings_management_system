<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight">
            {{ __('Apply for Loan') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <form method="POST" action="{{ route('loans.store') }}" class="space-y-6">
                    @csrf

                    <!-- Amount -->
                    <div>
                        <x-input-label for="amount" :value="__('Loan Amount (BDT)')" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" placeholder="Enter amount..." required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        <p class="mt-2 text-xs text-gray-500 italic">* Min loan amount: ৳1,000</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <x-input-label for="description" :value="__('Reason for Loan')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm" placeholder="Briefly describe why you need this loan..."></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-8 border-t border-gray-100 pt-6">
                        <a href="{{ route('loans.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4 font-medium">Cancel</a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Submit Application') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
