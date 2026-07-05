<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('تبدیل شماره حساب به شبا') }}
        </h2>
    </x-slot>

    <div class="py-10" dir="rtl">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">

            <x-dashboard.page-header
                title="تبدیل شماره حساب به شبا"
                description="شماره حساب و بانک مربوطه را وارد کنید تا شماره شبا و اطلاعات حساب را مشاهده کنید."
            />

            {{-- Failure / validation summary --}}
            @if (session('error'))
                <x-dashboard.alert type="error">
                    {{ session('error') }}
                </x-dashboard.alert>
            @endif

            {{-- Inquiry form --}}
            <x-dashboard.card
                title="اطلاعات حساب"
                subtitle="لطفاً شماره حساب را بدون فاصله و بانک صادرکننده را انتخاب کنید."
            >
                <form
                    method="POST"
                    action="{{ route('banking.account-to-sheba.store') }}"
                    x-data="{ loading: false }"
                    x-on:submit="loading = true"
                    class="space-y-5"
                >
                    @csrf

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <x-dashboard.input
                            name="accountNumber"
                            label="شماره حساب"
                            helper="فقط ارقام؛ بدون خط تیره یا فاصله."
                            type="text"
                            inputmode="numeric"
                            maxlength="30"
                            autocomplete="off"
                            dir="ltr"
                            value="{{ old('accountNumber') }}"
                            placeholder="۰۲۰۱۲۳۴۵۶۷۸۹۰"
                            class="text-left font-mono tracking-wide"
                            x-bind:readonly="loading"
                        />

                        <div>
                            <label for="bankCode" class="block text-sm font-medium text-slate-700">نام بانک</label>
                            <select
                                id="bankCode"
                                name="bankCode"
                                @class([
                                    'mt-2 block w-full rounded-xl border bg-white px-4 py-3 text-slate-900 shadow-sm transition focus:ring-4',
                                    'border-red-400 focus:border-red-500 focus:ring-red-100' => $errors->has('bankCode'),
                                    'border-slate-300 focus:border-blue-500 focus:ring-blue-100' => ! $errors->has('bankCode'),
                                ])
                            >
                                <option value="" disabled @selected(! old('bankCode'))>انتخاب بانک…</option>
                                @foreach ($banks as $code => $name)
                                    <option value="{{ $code }}" @selected(old('bankCode') === $code)>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('bankCode')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

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
                    $sheba = data_get($result, 'result.IBAN', data_get($result, 'IBAN', data_get($result, 'sheba')));
                    $status = data_get($result, 'result.accountStatus', data_get($result, 'accountStatus', data_get($result, 'status')));
                    $owners = data_get($result, 'result.owners', data_get($result, 'owners', []));

                    $activeTokens = ['فعال', 'active', 'open', '1', 'true', '02', 'A'];
                    $isActive = $status !== null && in_array((string) $status, $activeTokens, true);
                @endphp

                <x-dashboard.card>
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <h2 class="text-lg font-semibold text-slate-900">نتیجه استعلام</h2>
                        <x-dashboard.status-badge type="success">استعلام موفق</x-dashboard.status-badge>
                    </div>

                    {{-- Sheba, prominently displayed with copy-to-clipboard --}}
                    <div class="rounded-2xl border border-blue-100 bg-blue-50/60 p-5">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <div class="min-w-0">
                                <div class="text-xs font-medium text-slate-500">شماره شبا</div>
                                <div dir="ltr" class="mt-1 truncate text-left font-mono text-lg font-bold tracking-wider text-blue-800">
                                    {{ $sheba ? 'IR' . ltrim((string) $sheba, 'IRir') : '—' }}
                                </div>
                            </div>
                            @if ($sheba)
                                <x-dashboard.copy-button :value="'IR' . ltrim((string) $sheba, 'IRir')" />
                            @endif
                        </div>
                    </div>

                    <dl class="mt-4 divide-y divide-slate-100">
                        {{-- Account status indicator --}}
                        <div class="flex items-center justify-between gap-4 py-3">
                            <dt class="text-sm font-medium text-slate-500">وضعیت حساب</dt>
                            <dd>
                                @if ($status === null)
                                    <x-dashboard.status-badge type="neutral">نامشخص</x-dashboard.status-badge>
                                @elseif ($isActive)
                                    <x-dashboard.status-badge type="success">فعال</x-dashboard.status-badge>
                                @else
                                    <x-dashboard.status-badge type="error">غیرفعال</x-dashboard.status-badge>
                                @endif
                            </dd>
                        </div>

                        {{-- Account owners --}}
                        <div class="py-3">
                            <dt class="mb-2 text-sm font-medium text-slate-500">صاحبان حساب</dt>
                            <dd>
                                @if (! empty($owners) && is_array($owners))
                                    <ul class="space-y-2">
                                        @foreach ($owners as $owner)
                                            @php
                                                $ownerName = is_array($owner)
                                                    ? trim((string) data_get($owner, 'firstName') . ' ' . (string) data_get($owner, 'lastName'))
                                                    : (string) $owner;
                                                $ownerName = $ownerName !== '' ? $ownerName : 'نامشخص';
                                            @endphp
                                            <li class="flex items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 px-4 py-2.5">
                                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-xs font-semibold text-slate-600">
                                                    {{ mb_substr($ownerName, 0, 1) }}
                                                </span>
                                                <span class="text-sm font-medium text-slate-800">{{ $ownerName }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-sm text-slate-400">اطلاعاتی درباره صاحبان حساب دریافت نشد.</p>
                                @endif
                            </dd>
                        </div>
                    </dl>

                    @if (config('app.debug'))
                        <details class="mt-6 border-t border-slate-100 pt-4">
                            <summary class="cursor-pointer text-xs font-medium text-slate-400 hover:text-slate-600">
                                نمایش پاسخ خام (فقط محیط توسعه)
                            </summary>
                            <pre dir="ltr" class="mt-3 overflow-x-auto rounded-xl bg-slate-900 p-4 text-left text-xs text-slate-100"><code>{{ json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) }}</code></pre>
                        </details>
                    @endif
                </x-dashboard.card>
            @endif

        </div>
    </div>
</x-app-layout>
