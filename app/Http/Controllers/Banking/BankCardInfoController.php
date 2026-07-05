<?php

declare(strict_types=1);

namespace App\Http\Controllers\Banking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banking\BankCardInfoRequest;
use App\Services\ApiIr\BankCardService;
use App\Services\Logging\InquiryLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class BankCardInfoController extends Controller
{
    public function __construct(
        private readonly BankCardService $bankCardService,
        private readonly InquiryLogService $inquiryLog,
    ) {
    }

    /**
     * Show the card info inquiry form.
     */
    public function create(): View
    {
        return view('banking.card-info');
    }

    /**
     * Handle a card info inquiry.
     */
    public function store(BankCardInfoRequest $request): RedirectResponse
    {
        $cardNumber = $request->validated('cardNumber');

        try {
            $result = $this->bankCardService->getCardInfo($cardNumber);
        } catch (RuntimeException $e) {
            report($e);

            $this->inquiryLog->logCardInquiry(
                user: $request->user(),
                cardNumber: $cardNumber,
                status: 'failed',
            );

            return back()->with('error', 'دریافت اطلاعات کارت با خطا مواجه شد. لطفاً بعداً تلاش کنید.');
        }

        $this->inquiryLog->logCardInquiry(
            user: $request->user(),
            cardNumber: $cardNumber,
            status: 'success',
            httpStatus: 200,
            responsePayload: $result,
        );

        return back()->with('result', $result);
    }
}
