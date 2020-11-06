<?php


namespace App\Services;


use App\Jobs\SendMoney;
use App\Models\Prize;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\DB;

class UserService extends BaseService
{
    use DispatchesJobs;


    /**
     * @param $data
     * @return bool
     */
    public function updatePrize($data)
    {
        $user = auth()->user();
        if ($data['type'] == 3){
            return $this->saveThing($data, $user);
        }elseif ($data['type'] == 1){
            return $this->saveMoney($data, $user);
        }else{
            return $this->savePoint($data, $user);
        }
    }

    /**
     * @param $data
     * @param $user
     * @return bool
     */
    public function saveMoney($data, $user)
    {
        DB::beginTransaction();
        if (!$user->update(['money' => $data['money']])){
            DB::rollBack();
            return false;
        }

        $prize = Prize::where('type', 1)->first(['id', 'count', 'is_stock']);
        $prize->count- $data['money'] < config('settings.moneyEnd') ? $is_stock = \ConstBool::FALSE: $is_stock = \ConstBool::TRUE;
        $prize->count = $prize->count - $data['money'];
        $prize->is_stock = $is_stock;
        if (!$prize->save()){
            DB::rollBack();
            return false;
        }
        DB::commit();
        dispatch(new SendMoney($data['money']));
        return true;
    }

    /**
     * @param $data
     * @param $user
     * @return bool
     */
    public function savePoint($data, $user)
    {
        if (!$user->update(['count_points' => DB::raw("count_points+".$data['count_points'])])){
            return false;
        }
        return true;
    }

    /**
     * @param $data
     * @param $user
     * @return bool
     */
    public function saveThing($data, $user)
    {
        $thing_id = json_decode($data['thing'])->id;
        $name = json_decode($data['thing'])->name;
        $data['thing_id'] = $thing_id;
        $user->thing_id = $thing_id;
        DB::beginTransaction();
        if (!$user->save()){
            DB::rollBack();
            return false;
        }

        if (!$user->thing()->update([
            'name' => $name,
            'count' => DB::raw('count - 1'),
        ])){
            DB::rollBack();
            return false;
        }
        $prize = Prize::where('type', 3)->first(['id','count', 'is_stock']);
        $prize->count-1 == 0 ? $is_stock = \ConstBool::FALSE : $is_stock = \ConstBool::TRUE;
        $prize->count = $prize->count-1;
        $prize->is_stock = $is_stock;
        if (!$prize->save()){
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

}
