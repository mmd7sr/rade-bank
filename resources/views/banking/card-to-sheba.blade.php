<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('تبدیل شماره کارت به شبا') }}
        </h2>
    </x-slot>

    <div class="py-10" dir="rtl">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            <x-dashboard.page-header
                title="تبدیل شماره کارت به شبا"
                description="شماره کارت بانکی خود را وارد کنید تا شماره شبا و اطلاعات صاحب حساب را مشاهده کنید."
            />

            {{-- Failure / validation state --}}
            @if (session('error'))
                <x-dashboard.alert type="error">
                    {{ session('error') }}
                </x-dashboard.alert>
            @endif

            {{-- Inquiry form --}}
            <x-dashboard.card
                title="اطلاعات کارت"
                subtitle="لطفاً شماره کارت ۱۶ رقمی را بدون فاصله وارد کنید."
            >
                <form
                    method="POST"
                    action="{{ route('banking.card-to-sheba.store') }}"
                    x-data="{ loading: false }"
                    x-on:submit="loading = true"
                    class="space-y-5"
                >
                    @csrf

                    <x-dashboard.input
                        name="cardNumber"
                        label="شماره کارت"
                        helper="نمونه: ۶۰۳۷۹۹۱۲۳۴۵۶۷۸۹۰"
                        type="text"
                        inputmode="numeric"
                        maxlength="16"
                        autocomplete="off"
                        dir="ltr"
                        value="{{ old('cardNumber') }}"
                        placeholder="۶۰۳۷-۹۹**-****-۱۲۳۴"
                        class="text-left font-mono tracking-widest"
                        x-bind:readonly="loading"
                    />

                    <div class="flex items-center justify-start">
                        <x-dashboard.submit-button x-bind:disabled="loading">
                            <svg x-show="loading" x-cloak class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span x-text="loading ? 'در حال استعلام…' : 'استعلام شبا'">استعلام شبا</span>
                        </x-dashboard.submit-button>
                    </div>
                </form>
            </x-dashboard.card>

            {{-- Success result --}}
            @if (session('result'))
                @php
                    $result = session('result');

                    $sheba = data_get($result, 'data.iban');
                    $ownerName = data_get($result, 'data.name');
                    $bank = data_get($result, 'data.bankName');
                @endphp

                <x-dashboard.card>
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <h2 class="text-lg font-semibold text-slate-900">نتیجه استعلام</h2>
                        <x-dashboard.status-badge type="success">استعلام موفق</x-dashboard.status-badge>
                    </div>

                    {{-- Sheba: prominent, with copy-to-clipboard --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50/60 p-5">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0">
                                <div class="text-xs font-medium text-slate-500">شماره شبا</div>
                                <div dir="ltr" class="mt-1 truncate text-left font-mono text-lg font-bold tracking-wider text-blue-800">
                                    {{ $sheba ?? '—' }}
                                </div>
                            </div>
                            @if ($sheba)
                                <x-dashboard.copy-button :value="$sheba" />
                            @endif
                        </div>
                    </div>

                    <dl class="mt-4 divide-y divide-slate-100">
                        <x-dashboard.result-row label="نام صاحب حساب">
                            {{ $ownerName ?: '—' }}
                        </x-dashboard.result-row>

                        @if ($bank)
                            <x-dashboard.result-row label="نام بانک">
                                {{ $bank }}
                            </x-dashboard.result-row>
                        @endif

                        <x-dashboard.result-row label="وضعیت استعلام">
                            <x-dashboard.status-badge type="success">موفق</x-dashboard.status-badge>
                        </x-dashboard.result-row>
                    </dl>
                </x-dashboard.card>
            @endif

        </div>
    </div>
</x-app-layout>
