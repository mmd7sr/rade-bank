<?php

declare(strict_types=1);

namespace App\Http\Controllers\Banking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banking\AccountToShebaRequest;
use App\Services\ApiIr\AccountToShebaService;
use App\Services\Logging\InquiryLogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class AccountToShebaController extends Controller
{
    public function __construct(
        private readonly AccountToShebaService $accountToShebaService,
        private readonly InquiryLogService $inquiryLog,
    ) {
    }

    /**
     * Show the account-to-sheba inquiry form.
     */
    public function create(): View
    {
        return view('banking.account-to-sheba', [
            'banks' => (array) config('banks.list'),
        ]);
    }

    /**
     * Handle an account-to-sheba inquiry.
     */
    public function store(AccountToShebaRequest $request): RedirectResponse
    {
        $accountNumber = $request->validated('accountNumber');
        $bankCode = $request->validated('bankCode');

        try {
            $result = $this->accountToShebaService->convert($accountNumber, $bankCode);
        } catch (RuntimeException $e) {
            report($e);

            $this->inquiryLog->logAccountInquiry(
                user: $request->user(),
                accountNumber: $accountNumber,
                bankCode: $bankCode,
                status: 'failed',
            );

            return back()
                ->withInput()
                ->with('error', 'در حال حاضر دریافت اطلاعات ممکن نیست. لطفاً کمی بعد دوباره تلاش کنید.');
        }

        $this->inquiryLog->logAccountInquiry(
            user: $request->user(),
            accountNumber: $accountNumber,
            bankCode: $bankCode,
            status: 'success',
            httpStatus: 200,
            responsePayload: $result,
        );

        return back()->with('result', $result);
    }
}
