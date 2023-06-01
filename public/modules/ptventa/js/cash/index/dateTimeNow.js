document.addEventListener('DOMContentLoaded', () => {
    const dateInput = document.getElementById('date');

    function formatDateTime(date) {
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        const hours = date.getHours().toString().padStart(2, '0');
        const minutes = date.getMinutes().toString().padStart(2, '0');
        const seconds = date.getSeconds().toString().padStart(2, '0');
        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function updateDate() {
        const currentDate = formatDateTime(new Date());
        dateInput.value = currentDate;
    }

    updateDate(); // Actualizar la fecha inicialmente

    setInterval(updateDate, 1000); // Actualizar la fecha cada segundo
});