<?php


namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->baseService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updatePrize(Request $request)
    {
        $updated = $this->baseService->updatePrize($request->all());
        return view('prize', compact('updated'));
    }
}
