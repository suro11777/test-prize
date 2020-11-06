<?php


namespace App\Http\Controllers;


use App\Services\PrizeService;

class PrizeController extends BaseController
{

    /**
     * PrizeController constructor.
     * @param PrizeService $prizeService
     */
    public function __construct(PrizeService $prizeService)
    {
        $this->baseService = $prizeService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPrize()
    {
        list($getPrize, $type, $whatDidYouWin) = $this->baseService->getPrize();
        return view('prize.show', compact('getPrize', 'type', 'whatDidYouWin'));
    }
}
