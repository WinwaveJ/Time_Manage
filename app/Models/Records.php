<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Records extends Model
{
    protected $table = "records";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function create_record($event)
    {
        try {
            $res = self::create([
                'event' => $event,
                'status' => 0
            ]);
            return $res;
        } catch (\Exception $e) {
            logError('开始记录失败', [$e->getMessage()]);
            return false;
        }

    }

    public static function stop_record($id)
    {
        try {
            $res = self::where('id', $id)
                ->update([
                    'end_time' => date('Y-m-d H:i:s', time()),
                    'status' => 1,
                ]);
            return $res;
        } catch (\Exception $e) {
            logError('停止记录失败', [$e->getMessage()]);
            return false;
        }

    }

    public static function get_time_both($event)
    {
        try {
            $res = self::select('created_at', 'end_time')
                ->where('event', $event)
                ->where('status', 1)
                ->get();
            return $res;
        } catch (\Exception $e) {
            logError('获取起止时间失败', [$e->getMessage()]);
            return false;
        }

    }

}
