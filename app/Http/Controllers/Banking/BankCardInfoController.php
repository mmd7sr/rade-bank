<?php

declare(strict_types=1);

namespace App\Http\Controllers\Banking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banking\BankCardInfoRequest;
use App\Services\ApiIr\BankCardService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class BankCardInfoController extends Controller
{
    public function __construct(private readonly BankCardService $bankCardService)
    {
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
        try {
            $result = $this->bankCardService->getCardInfo(
                $request->validated('cardNumber'),
            );
        } catch (RuntimeException $e) {
            report($e);

            return back()->with('error', 'دریافت اطلاعات کارت با خطا مواجه شد. لطفاً بعداً تلاش کنید.');
        }

        return back()->with('result', $result);
    }
}
