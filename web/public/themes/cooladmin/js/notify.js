var notificationsWrapper   = $('.js-item-menu');
var notifications          = notificationsWrapper.find('ul.item_notify');
var notificationsCountElem = notificationsWrapper.find('i[data-count]');
var notificationsCount     = parseInt(notificationsCountElem.data('count'));
var pusher = new Pusher('c50f82e93ae8782f2039', {
    encrypted: true,
    cluster: "ap1"
});

/**
 * Subscribe to the channel and bind to event
 * @param {Int} _userId User's id 
 * @param {Int} _roleId User's role id
 */
function fnSubNotifyChannels(_userId, _roleId) {
  // Subscribe to the channel we specified in our Laravel Event
  var channel     = pusher.subscribe('notification-channel');
  var allEvent    = 'notification-event-all';
  var roleEvent   = 'notification-event-role' + _roleId;
  var userEvent   = 'notification-event-one' + _userId;
  // Bind a function to a Event (the full Laravel class)
  // Bind event notification for all
  channel.bind(allEvent, function(_data) {
    fnNewNotification(_data);
  });
  // Bind event notification for role
  channel.bind(roleEvent, function(_data) {
    fnNewNotification(_data);
  });
  // Bind event notification for user
  channel.bind(userEvent, function(_data) {
    fnNewNotification(_data);
  });
};

/**
 * Create popup and show notification
 * @param {JSON} _data    Show in popup and put in fnShowNotify()
 */
function fnNewNotification(_data) {
  var createTime = new Date();
  alertify.success('You have a new message: ' + _data.content + '');
  fnShowNotify(_data, createTime);
  // Icon notification will display a red dot
  $('.notify').addClass('has-noti');
};

/**
 * Create notification and display in list notification
 * @param {JSON} _data          Data will display in list
 * @param {Date} _createTime    Time display in list    
 */
function fnShowNotify(_data, _createTime) { 
  // reload = setInterval(formatDate,1000,n);
    var existingNotifications = notifications.html();
    // Insert notification into list notification
    var newNotificationHtml = `
        <li class="notifi__item">
            <a class="bg-c1 img-cir img-40" href="` + _data.url + `">
                <i class="zmdi zmdi-account-box"></i>
            </a>
            <a class="content" href="` + _data.url + `">
                <p>` + _data.content + `</p>
                <span class="date time-ago" id="time" data-create-at="` + _createTime + `"></span>
            </a>
        </li>
    `;
    // Count amount notification
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('#notify-count').text(notificationsCount);
    // Show notifications on dropdown list
    notifications.html(newNotificationHtml + existingNotifications);
    notificationsWrapper.show();
};

/**
 * Format date time to value time ago
 * @param {Date} _date       Initial time
 * @returns                  Value time ago
 */
function fnFormatDate(_date) {
  // Get second has passed from _date
  var seconds = Math.floor((new Date() - _date) / 1000);
  var retVal; 
  var years = seconds / 31553280;             // Value 31553280 = (365*4+366)/5 * 86400 = the seconds in 1 year
  if (years > 1) {
    retVal = Math.floor(years) + " years ago";          
  } else {
    months = seconds / 2629440;               // Value 2629440 = ((365*4+366)/5/12) * 86400  = the seconds in 1 month
    if (months > 1) {
      retVal = Math.floor(months) + " months ago";
    } else {
      days = seconds / 86400;                 // Value 86400 = 3600 * 24 = the seconds in 1 day
      if (days > 1) {
        retVal = Math.floor(days) + " days ago";
      } else {
        hours = seconds / 3600;               // Value 3600 = 60 minutes * 60 seconds = the second in i hour
        if (hours > 1) {
          retVal = Math.floor(hours) + " hours ago";
        } else {
          minutes = seconds / 60;             // Value 60 = the seconds in 1 minute
          if (minutes > 1) {
            retVal = Math.floor(minutes) + " minutes ago";
          } else {
            retVal = " Right now";
          }
        }
      }
    }
  }
  return retVal;
};