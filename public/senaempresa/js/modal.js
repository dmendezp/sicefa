const myModal = document.getElementById('myModal');
const openModalBtn = document.getElementById('openModalBtn');

openModalBtn.addEventListener('click', () => {
    const bootstrapModal = new bootstrap.Modal(myModal);
    bootstrapModal.show();

    const myInput = document.getElementById('myInput');
    if (myInput) {
        myInput.focus();
    }
});




