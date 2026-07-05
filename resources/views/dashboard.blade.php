<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('داشبورد') }}
        </h2>
    </x-slot>

    <div class="py-10" dir="rtl">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            <x-dashboard.page-header
                title="{{ 'خوش آمدید، ' . Auth::user()->name }}"
                description="از میان خدمات بانکی زیر، سرویس مورد نظر خود را انتخاب کنید."
            />

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <x-dashboard.service-card
                    title="استعلام اطلاعات کارت"
                    description="مشاهده اطلاعات دارنده و بانک صادرکننده کارت."
                    :href="route('banking.card-info.create')"
                >
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="5" width="18" height="14" rx="2" />
                            <path stroke-linecap="round" d="M3 10h18" />
                        </svg>
                    </x-slot>
                </x-dashboard.service-card>

                <x-dashboard.service-card
                    title="تبدیل کارت به شبا"
                    description="دریافت شماره شبا از روی شماره کارت بانکی."
                    :href="route('banking.card-to-sheba.create')"
                >
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h11m0 0-3-3m3 3-3 3M20 17H9m0 0 3-3m-3 3 3 3" />
                        </svg>
                    </x-slot>
                </x-dashboard.service-card>

                <x-dashboard.service-card
                    title="تبدیل حساب به شبا"
                    description="دریافت شماره شبا و اطلاعات حساب از روی شماره حساب."
                    :href="route('banking.account-to-sheba.create')"
                >
                    <x-slot name="icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 10 12 4l8 6M5 10v9h14v-9M9 19v-5h6v5" />
                        </svg>
                    </x-slot>
                </x-dashboard.service-card>
            </div>

        </div>
    </div>
</x-app-layout>
