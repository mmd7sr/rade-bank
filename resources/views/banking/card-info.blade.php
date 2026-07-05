<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('استعلام اطلاعات کارت بانکی') }}
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Inquiry form --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">اطلاعات کارت</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            شماره کارت ۱۶ رقمی را وارد کنید تا اطلاعات آن استعلام شود.
                        </p>
                    </div>

                    @if (session('error'))
                        <div class="mb-6 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('banking.card-info.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="cardNumber" class="block text-sm font-medium text-gray-700">
                                شماره کارت
                            </label>
                            <input
                                id="cardNumber"
                                name="cardNumber"
                                type="text"
                                inputmode="numeric"
                                maxlength="16"
                                autocomplete="off"
                                dir="ltr"
                                value="{{ old('cardNumber') }}"
                                placeholder="۶۰۳۷۹۹۱۲۳۴۵۶۷۸۹۰"
                                class="mt-1 block w-full text-left tracking-widest font-mono rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('cardNumber') border-red-500 @enderror"
                            />
                            @error('cardNumber')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-start">
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition"
                            >
                                استعلام
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Result --}}
            @if (session('result'))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 sm:p-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">نتیجه استعلام</h3>
                        <pre dir="ltr" class="bg-gray-900 text-gray-100 text-sm rounded-md p-4 overflow-x-auto text-left"><code>{{ json_encode(session('result'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</code></pre>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
