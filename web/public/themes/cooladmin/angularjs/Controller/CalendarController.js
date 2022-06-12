app.controller("CalendarController", function ($scope, $http) {
    /**
     * AJAX retrieves search results name calendar
     * @param $scope.calendar.name
     */
    $scope.searchCalendar = function () {
        $http({
            url: '/admin/searchCalendar',
            method: 'POST',
            data: JSON.stringify({ data: $scope.calendar.name })
        }).then(function successCallBack(response) {
            console.log($scope.oldName);
            if (response.data == 1 ) {
                if ($scope.calendar.name == $scope.oldName)
                {
                    $scope.existName = false;
                }
                else
                {
                    $scope.existName = true;
                }
            } else {
                $scope.existName = false;
            }
        });
    }
    /**
     * AJAX retrieves search results name calendar
     */
    $scope.getListCalendars = function () {
        $http({
            url: '/admin/getListCalendars',
            method: 'GET',
        }).then(function successCallBack(response) {
            $scope.calendars = response.data;
        });
    }
    /**
     * AJAX retrieves create new calendar
     */
    $scope.createCalendar = function () {
        $scope.calendars.push($scope.calendar);
        $http({
            url: '/admin/createCalendar',
            method: 'POST',
            data: JSON.stringify({ data: $scope.calendar })
        }).then(function successCallBack(response) {
            $scope.reset();
        });
    }

    /**
     * AJAX retrieves delete calendar
     * @param id
     * @param index
     */
    $scope.deleteCalendar = function (id, index) {
        $scope.calendars.splice(index, 1);
        $http({
            url: '/admin/deleteCalendar',
            method: 'POST',
            data: JSON.stringify({ data: id })
        }).then(function successCallBack(response) {
            $scope.reset();
        });
    }

    /**
     * AJAX retrieves update calendar
     * @param $scope.calendar
     */
    $scope.updateCalendar = function () {
        $http({
            url: '/admin/updateCalendar',
            method: 'POST',
            data: JSON.stringify({ data: $scope.calendar })
        }).then(function successCallBack(response) {
            $scope.reset();
        });
    }

    /**
     * Handle event click button edit
     */
    $scope.editCalendar = function (calendar) {
        $scope.calendar = calendar;
        $scope.oldName = calendar.name;
        $scope.create = false;
    }

    /**
     * Handle event reset input after action
     */
    $scope.reset = function () {
        $scope.getListCalendars();
        $scope.oldName = "";
        $scope.calendar = {};
    }
});
