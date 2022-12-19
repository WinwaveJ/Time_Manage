<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = "events";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    /**
     * 检查事件是否已经存在
     * @param $event
     * @return false
     */
    public static function check_event($event)
    {
        try {
            $res = self::select('event')
                ->where('event', $event)
                ->get()
                ->count();
            return $res;
        } catch (\Exception $e) {
            logError("检查事件失败", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 获取所有事件
     * @param $event
     * @return false
     */
    public static function get_events()
    {
        try {
            $res = self::select('event')
                ->get();
            return $res;
        } catch (\Exception $e) {
            logError("修改事件失败", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 添加事件
     * @param $event
     * @return false
     */
    public static function add_event($event)
    {
        try {
            $res = self::create([
                'event' => $event
            ]);
            return $res;
        } catch (\Exception $e) {
            logError("添加事件失败", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 修改事件
     * @param $event
     * @return bool
     */
    public static function mod_event($event)
    {
        try {
            $res = self::where('event', $event)
                ->update([
                    'event' => $event
                ]);
            return $res;
        } catch (\Exception $e) {
            logError("修改事件失败", [$e->getMessage()]);
            return false;
        }
    }

    /**
     * 删除事件
     * @param $event
     * @return false
     */
    public static function del_event($event)
    {
        try {
            $res = self::where('event', $event)
                ->delete();
            return $res;
        } catch (\Exception $e) {
            logError("修改事件失败", [$e->getMessage()]);
            return false;
        }
    }
}
