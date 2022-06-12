<?php

namespace Modules\Admin\Entities;

use App\Entities\RootModel;
use App\Utils\GraphApiHandle;
use Microsoft\Graph\Model\Calendar;

class AdminCalendar extends RootModel
{
    const MODEL_CLASS = Calendar::class;
    const URL_EVENT = '/me/calendars/';

    /**
     * Get List Calendars
     *
     * @return array calendars
     */
    public static function getListCalendars()
    {
        return GraphApiHandle::executeGetApi(self::MODEL_CLASS, self::URL_EVENT . "?", '', '');
    }

    /**
     * Create Calendar
     *
     * @param  mixed $data
     * @return void
     */
    public static function createCalendar($data)
    {
        return GraphApiHandle::executePostApi(self::MODEL_CLASS, self::URL_EVENT, $data);
    }

    /**
     * Delete Calendar
     *
     * @param  mixed $data
     * @return void
     */
    public static function deleteCalendar($id)
    {
        return GraphApiHandle::executeDeleteApi(self::MODEL_CLASS, self::URL_EVENT, $id);
    }

    /**
     * Update Calendar
     *
     * @param  mixed $id
     * @return void
     */
    public static function updateCalendar($data)
    {
        return GraphApiHandle::executePathApi(self::MODEL_CLASS, self::URL_EVENT, $data);
    }

    /**
     * Search Calendar
     *
     * @param  mixed $data
     * @return void
     */
    public static function searchCalendar($key, $value)
    {
        $data = GraphApiHandle::executeGetApi(self::MODEL_CLASS, self::URL_EVENT . "?", '$filter', $key . " eq '" . $value . "'");
        if ($data) {
            return 1;
        }
        return 0;
    }
}
