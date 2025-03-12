import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    Echo.channel('notifications')
        .listen('NewNotificationEvent', (data) => {
            console.log("New notification received: ", data.message);
            alert("New notification: " + data.message);
        });
});
