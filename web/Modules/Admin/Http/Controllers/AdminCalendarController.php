<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Entities\AdminCalendar;

class AdminCalendarController extends Controller
{
    public function index()
    {
        $viewData = $this->loadViewData();
        if (!session('userName')) {
            return redirect()->route('signin');
        } else {
            return view('admin::admin-calendars.index', $viewData);
        }
    }

    /**
     * Ajax action: Handle /admin/getListCalendars
     *
     */
    public function getListCalendars()
    {
        return json_encode(AdminCalendar::getListCalendars());
    }

    /**
     * Ajax action: Handle /admin/createCalendar
     *
     * @param  Request $request Request object
     */
    public function createCalendar(Request $request)
    {
        return AdminCalendar::createCalendar($request->data);
    }

    /**
     * Ajax action: Handle /admin/deleteCalendar
     *
     * @param  Request $request Request object
     */
    public function deleteCalendar(Request $request)
    {
        return AdminCalendar::deleteCalendar($request->data);
    }

    /**
     * Ajax action: Handle /admin/updateCalendar
     *
     * @param  Request $request Request object
     */
    public function updateCalendar(Request $request)
    {
        return AdminCalendar::updateCalendar($request->data);
    }

    /**
     * Ajax action: Handle /admin/searchCalendar
     *
     * @param  Request $request Request object
     */
    public function searchCalendar(Request $request)
    {
        return AdminCalendar::searchCalendar('name', $request->data);
    }
}
