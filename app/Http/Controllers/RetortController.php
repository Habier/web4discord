<?php

namespace App\Http\Controllers;

use App\Http\Requests\RetortRequest;
use App\Models\Retort;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use src\Services\RetortService;

class RetortController extends Controller
{

    public function __construct(private RetortService $retortService)
    {
    }

    public function index()
    {
        $retorts = Retort::where('user_id', Auth::id())->get();
        return Inertia::render('Retort/Index', ['retorts' => $retorts]);
    }

    public function browseAll()
    {
        $retorts = Retort::all();
        return view('retorts.complete', ['retorts' => $retorts]);
    }

    public function store(RetortRequest $request): RedirectResponse
    {
        $this->retortService->store($request);
        return redirect()->action([RetortController::class, 'index']);
    }

    /**
     * @param Request $request
     * @param Retort $retort
     * @return RedirectResponse
     */
    public function destroy(Request $request, Retort $retort)
    {
        $this->retortService->destroy($retort);

        return redirect()->route('retorts.index');
    }

    public function download(Request $request)
    {
        $latestRetort = Retort::latest()->first();

        $card = $this->retortService->downloadableString();

        return response($card)->withHeaders([
            'Content-Type' => 'text/plain',
            'Cache-Control' => 'no-store, no-cache',
            'Content-Disposition' => 'attachment; filename="last_retort_custom_card_' . $latestRetort->created_at->toDateTimeString() . '.txt',
        ]);
    }
}
