{{-- Primary submit button. Pair with an Alpine `loading` flag on the form for
     duplicate-submission protection (see the card-to-sheba page). --}}
<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-100 disabled:cursor-not-allowed disabled:opacity-60',
    ]) }}
>
    {{ $slot }}
</button>
