<?php
use Modules\Admin\Entities\AdminNotification;
$theme = 'themes/cooladmin/';
?>

<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Module Admin</title>

        {{-- Laravel Mix - CSS File --}}

        <!-- Fontfaces CSS-->
        <link href="{{ url($theme . 'css/font-face.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link href="{{ url($theme . 'css/notify.css') }}" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="{{ url($theme . 'vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

        <!-- Vendor CSS-->
        <link href="{{ url($theme . 'vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/wow/animate.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/slick/slick.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
        <link href="{{ url($theme . 'vendor/vector-map/jqvmap.min.css') }}" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="{{ url($theme . 'css/theme.css') }}" rel="stylesheet" media="all">

    </head>
    <body class="">
        <div class="page-wrapper">
            <!-- MENU SIDEBAR-->
            @include('cooladmin.layouts.menu')
            <!-- END MENU SIDEBAR-->

            <!-- PAGE CONTAINER-->
            <div class="page-container2">
                <!-- HEADER DESKTOP-->
                <header class="header-desktop2">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="header-wrap2">
                                <div class="logo d-block d-lg-none">
                                    <a href="#">
                                        <img src="{{ url($theme . 'images/icon/logo-white.png') }}" alt="Betech" />
                                    </a>
                                </div>
                                <div class="header-button2">
                                    <div class="header-button-item js-item-menu">
                                        <i class="zmdi zmdi-search"></i>
                                        <div class="search-dropdown js-dropdown">
                                            <form action="">
                                                <input class="au-input au-input--full au-input--h65" type="text" placeholder="Search for datas &amp; reports..." />
                                                <span class="search-dropdown__icon">
                                                    <i class="zmdi zmdi-search"></i>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                        // TODO: Get notification from database to display in list notification
                                            $notifications = [];
                                            if (Auth::check()) {
                                                // Get notification from database
                                                $notifications  = AdminNotification::getCurrentUserNotifications();
                                                // Get user's id and role id to receiver notification
                                                $userId         = Auth::user()->id;
                                                $roleId         = Auth::user()->role_id;
                                            }
                                            // Count the number of notificaions to display in notification list title
                                            $countNotify        = count($notifications);
                                    ?> 
                                        <div class="header-button-item js-item-menu notify">
                                        <i class="zmdi zmdi-notifications" data-count="{{ $countNotify }}"></i>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title d-flex">
                                                <p>You have <span id="notify-count">{{ $countNotify }}</span> Notifications</p>
                                                <button class="btn btn-link btn-sm" id="read-all">Mark all as read</button>
                                            </div>
                                            <ul class="item_notify">
                                                @foreach ($notifications as $notify)
                                                    <li class="notifi__item" data-id-notify="{{ $notify->id }}">
                                                        <a class="bg-c1 img-cir img-40" href="{{ $notify->url }}">
                                                            <i class="zmdi zmdi-account-box"></i>
                                                        </a>
                                                        <a class="content" href="{{ $notify->url }}">
                                                            <p>{!! $notify->content !!}</p>
                                                            <span class="date time-ago" data-create-at="{{ $notify->created_at }}">{{ $notify->created_at->diffForHumans() }}</span>
                                                        </a>
                                                        @if ($notify->type == AdminNotification::TYPE_SEND_ONE)
                                                            @if ($notify->status == AdminNotification::STATUS_SENT)
                                                            <i class="check-read fa fa-circle my-auto" data-id-notify="{{ $notify->id }}"></i>
                                                            @endif
                                                        @elseif ($notify->rUsers->isEmpty())
                                                            <i class="check-read fa fa-circle my-auto" data-id-notify="{{ $notify->id }}"></i>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="header-button-item mr-0 js-sidebar-btn">
                                        <i class="zmdi zmdi-menu"></i>
                                    </div>
                                    <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-globe"></i>Language</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-pin"></i>Location</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-email"></i>Email</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-notifications"></i>Notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                @include('cooladmin.layouts.menu_mobile')
                <!-- END HEADER DESKTOP-->

                <!-- BREADCRUMB-->
                <section class="au-breadcrumb m-t-75">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="au-breadcrumb-content">
                                        <div class="au-breadcrumb-left">
                                            <span class="au-breadcrumb-span">You are here:</span>
                                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                                <li class="list-inline-item active">
                                                    <a href="/admin">Home</a>
                                                </li>
                                                <li class="list-inline-item seprate">
                                                    <span>/</span>
                                                </li>
                                                <li class="list-inline-item">Dashboard</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- END BREADCRUMB-->

                <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js"></script>
        <script src="{{ url($theme . 'angularjs/angularjsConfig.js')}}"></script>
        <script src="{{ url($theme . 'vendor/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/bootstrap-4.1/popper.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/slick/slick.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/wow/wow.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/animsition/animsition.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/counter-up/jquery.waypoints.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/counter-up/jquery.counterup.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/circle-progress/circle-progress.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ url($theme . 'vendor/chartjs/Chart.bundle.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/select2/select2.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/vector-map/jquery.vmap.js') }}"></script>
        <script src="{{ url($theme . 'vendor/vector-map/jquery.vmap.min.js') }}"></script>
        <script src="{{ url($theme . 'vendor/vector-map/jquery.vmap.sampledata.js') }}"></script>
        <script src="{{ url($theme . 'vendor/vector-map/jquery.vmap.world.js') }}"></script>
        <script src="{{ url($theme . 'js/main.js') }}"></script>
        <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
        <script src="{{ url($theme . 'js/notify.js') }}"></script>
        @section('scripts')
        <script>
            $(document).ready(function() {
                // TODO: Set time zone
                // Sub channel pusher
                @if (Auth::check())
                fnSubNotifyChannels('{{ $userId }}', '{{ $roleId }}');
                @endif
                // Create loop interval (per second) and update value of Notification's time
                timer = setInterval(function () {
                    $(".time-ago").each(function() {
                        // Get time created from notification
                        var createdAt = new Date($(this).attr('data-create-at'));
                        // Get minutes difference from time zone and change to milliseconds
                        var timeZone  = createdAt.getTimezoneOffset() * -(60 * 1000);
                        // Change date time by user's timezone
                        var dateTime = new Date(createdAt.valueOf() + timeZone);
                        $(this).text(fnFormatDate(dateTime));
                    });
                }, 1000);
                // If has notificaion unread, icon notification will display a red dot
                if ($('i').hasClass("check-read")) {
                    $('.notify').addClass('has-noti');
                }
                @if (Auth::check())
                    $('#read-all').click(function() {
                        $.ajax({
                            url: "{{ route('admin.readAllNotify') }}",
                            type: 'POST',
                            data: {
                                "_token": '{{ csrf_token() }}'
                            },
                        });
                        $('.check-read').each(function() {
                            $(this).hide();
                        });
                        // If click on mask all as read, icon notification will hide a red dot
                        $('.notify').removeClass('has-noti');
                    });
                @endif
            });
            // If click on blue dot after notificaion will mask as read and hide dot
            $('.check-read').each(function() {
                $(this).click(function() {
                    id = $(this).data('id-notify');
                    fnMaskAsReadNotify(id);
                    $(this).hide();
                });
            });
            // If click on notificaion will mask as read this notificaion
            $('.notifi__item a').each(function() {
                $(this).click(function() {
                    id = $(this).parent().data('id-notify');
                    fnMaskAsReadNotify(id);
                    $('.check-read[data-id-notify='+id+']').hide();
                });
            });
            /**
             * Mask as read notification
             * @param {int} _id  Notification's id
             */
            function fnMaskAsReadNotify(_id) {
                var id = _id;
                var url = '{{ route("admin.doRead", ":id") }}';
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        "_token": '{{ csrf_token() }}',
                    },
                    error: function() {
                        alert("Cannot mark as read");
                    }
                });
            };
        </script>
        @endsection
        @yield('scripts')
    </body>
</html>