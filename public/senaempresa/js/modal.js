document.addEventListener('DOMContentLoaded', function () {
    const openModalButtons = document.querySelectorAll('.openModalBtn');
    const vacancyTitle = document.getElementById('vacancyTitle');
    const vacancyDescription = document.getElementById('vacancyDescription');
    const vacancyRequirements = document.getElementById('vacancyRequirements');

    openModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            const vacancyData = JSON.parse(this.getAttribute('data-vacancy'));

            vacancyTitle.textContent = vacancyData.name;
            vacancyDescription.textContent = vacancyData.description_general;
            vacancyRequirements.textContent = vacancyData.requirement;
           
        });
    });
});