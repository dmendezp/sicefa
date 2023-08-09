function updateRealTimeDate() {
    const realTimeDateElement = document.getElementById('real-time-date');
    const currentDate = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = currentDate.toLocaleDateString('es-ES', options);
    realTimeDateElement.textContent = formattedDate;
}

setInterval(updateRealTimeDate, 1000);

updateRealTimeDate();