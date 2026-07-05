@props([
    'number',
])

@php
    // Presentation-only masking: 6037-99**-****-1234. Never render a full PAN.
    $digits = preg_replace('/\D/', '', (string) $number) ?? '';
    $masked = strlen($digits) === 16
        ? substr($digits, 0, 4) . '-' . substr($digits, 4, 2) . '**-****-' . substr($digits, -4)
        : '—';
@endphp

<span dir="ltr" class="font-mono tracking-wide">{{ $masked }}</span>
