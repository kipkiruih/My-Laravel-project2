import './bootstrap';
import $ from 'jquery';
window.$ = window.jQuery = $;


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

document.getElementById('notificationsDropdown').addEventListener('click', function() {
    fetch("{{ route('notifications.read') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            "Content-Type": "application/json"
        }
    }).then(response => response.json()).then(data => {
        if (data.success) {
            document.getElementById('notificationCount').innerText = 0;
        }
    });
});
