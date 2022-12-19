<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Events;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    /**
     * 获取事件列表
     * @return JsonResponse
     */
    public function get_events()
    {
        $res = Events::get_events();
        return $res ?
            json_success("获取成功", $res, 200) :
            json_fail("获取失败", null, 100);
    }

    /**
     * 添加事件
     * @param EventRequest $request
     * @return JsonResponse
     */
    public function add_event(EventRequest $request)
    {
        $event = $request['event'];
        $cnt = Events::check_event($event);
        if ($cnt > 0) {
            return json_fail("添加失败，事件已存在", null, 100);
        }
        $res = Events::add_event($event);
        return $res ?
            json_success("添加成功", $res, 200):
            json_fail("添加失败", null, 100);
    }

    /**
     * 修改事件
     * @param EventRequest $request
     * @return JsonResponse
     */
    public function mod_event(EventRequest $request){
        $event = $request['event'];
        $cnt = Events::check_event($event);
        if ($cnt == 0) {
            return json_fail("修改失败，事件不存在", null, 100);
        }
        $res = Events::mod_event($event);
        return $res ?
            json_success("修改成功", $res, 200):
            json_fail("修改失败", null, 100);
    }

    /**
     * 删除事件
     * @param EventRequest $request
     * @return JsonResponse
     */
    public function del_event(EventRequest $request){
        $event = $request['event'];
        $cnt = Events::check_event($event);
        if ($cnt == 0) {
            return json_fail("删除失败，事件不存在", null, 100);
        }
        $res = Events::mod_event($event);
        return $res ?
            json_success("删除成功", $res, 200):
            json_fail("删除失败", null, 100);
    }
}
