import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {
    Echo.channel('notifications')
        .listen('NewNotificationEvent', (data) => {
            console.log("New notification received: ", data.message);
            alert("New notification: " + data.message);
        });
});
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    duration: 1000,
    once: true,
});