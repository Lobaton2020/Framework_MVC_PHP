const closeAlerts = () => {
    setTimeout(() => {
        $('.alert').alert('close');
    }, 5000);
};

window.addEventListener("DOMContentLoaded", () => {
    closeAlerts();
})