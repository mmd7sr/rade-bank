<?php

declare(strict_types=1);

namespace App\Http\Controllers\Banking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banking\CardToShebaRequest;
use App\Services\ApiIr\CardToShebaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class CardToShebaController extends Controller
{
    public function __construct(private readonly CardToShebaService $cardToShebaService)
    {
    }

    /**
     * Show the card-to-sheba conversion form.
     */
    public function create(): View
    {
        return view('banking.card-to-sheba');
    }

    /**
     * Handle a card-to-sheba conversion.
     */
    public function store(CardToShebaRequest $request): RedirectResponse
    {
        try {
            $result = $this->cardToShebaService->convert($request->validated('cardNumber'));
        } catch (RuntimeException $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'در حال حاضر دریافت اطلاعات ممکن نیست. لطفاً کمی بعد دوباره تلاش کنید.');
        }

        return back()->with('result', $result);
    }
}
