<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Events;
use App\Models\Records;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * 开始记录
     * @param EventRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create_record(EventRequest $request)
    {
        $event = $request['event'];
        $res = Records::create_record($event);
        return $res ?
            json_success('记录成功', $res, 200) :
            json_fail('记录失败', null, 100);
    }

    public function stop_record(Request $request)
    {
        $id = $request['id'];
        $res = Records::stop_record($id);
        return $res ?
            json_success('停止成功', $res, 200) :
            json_fail('停止失败', null, 100);
    }

    public function get_time_use()
    {
        $events = Events::get_events()->toArray();
        $res = [];
        for ($i = 0; $i < count($events); $i++) {
            $time = Records::get_time_both($events[$i]['event'])->toArray();
            $total_time = 0;
            for ($j = 0; $j < count($time); $j++) {
                $s_time = $time[$j]['created_at'];
                $e_time = $time[$j]['end_time'];
                $s_time = strtotime($s_time);
                $e_time = strtotime($e_time);
                $total_time += $e_time - $s_time;
            }
            $temp = '';
            if (intval($total_time / 3600) > 0) {
                $temp = $temp . intval($total_time / 3600) . '小时';
            }
            if (intval($total_time % 3600 / 60) > 0) {
                $temp = $temp . intval($total_time % 3600 / 60) . '分钟';
            }
            $temp = $temp . $total_time % 3600 % 60 . '秒';
            $res[$events[$i]['event']] = $temp;
        }
        return $res ?
            json_success('获取成功', $res, 200) :
            json_fail('获取失败', null, 100);
    }


}
