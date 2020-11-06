<?php


namespace App\Services;


use App\Models\Prize;

class PrizeService extends BaseService
{

    /**
     * @return array|bool
     */
    public function getPrize()
    {
        $prize = Prize::with('things:id,prize_id,name,count')->where('is_stock', true)->inRandomOrder()->first(['id','type', 'count']);
        if (!$prize){
            return false;
        }
        $moneyStart = config('settings.money_start');
        $moneyEnd = config('settings.money_end');
        $pointStart = config('settings.point_start');
        $pointEnd = config('settings.point_end');
        $getPrize = null;
        switch ($prize->type){
            case \ConstPrizeType::MONEY:
                $getPrize = rand($moneyStart, $moneyEnd);
                $type = \ConstPrizeType::MONEY;
                $whatDidYouWin = '$';
                break;
            case \ConstPrizeType::POINT:
                $getPrize = rand($pointStart, $pointEnd);
                $type = \ConstPrizeType::POINT;
                $whatDidYouWin = 'point';
                break;
            default:
                $getPrize = $prize->things->shuffle()->where('count', '>', 0)->first();
                $type = \ConstPrizeType::THING;
                $whatDidYouWin = ' this thing';
        }
        auth()->user()->when_played = time();
        auth()->user()->save();
        return [$getPrize, $type, $whatDidYouWin];
    }
}
