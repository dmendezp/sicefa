//mostrar fecha actual
function updateRealTimeDate() {
    const realTimeDateElement = document.getElementById('real-time-date');
    const currentDate = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = currentDate.toLocaleDateString('es-ES', options);
    realTimeDateElement.textContent = formattedDate;
}

setInterval(updateRealTimeDate, 1000);

updateRealTimeDate();




//tiempo de las alertas
setTimeout(function() {
    $('.alert').alert('close');
}, 2000);


var closeBtn = document.querySelectorAll(".close"),
    card = document.querySelectorAll(".card"),
    btnActions = document.querySelectorAll(".btn");

closeBtn.forEach(function(el) {
  el.addEventListener("click", closeCard);
});

card.forEach(function(el) {
  el.addEventListener("click", openCard);
});

btnActions.forEach(function(el) {
  el.addEventListener("click", clickBtn);
});

function closeCard(event) {
  event.stopPropagation();
  event.target.closest(".card").classList.add("closed");

}

function openCard(event) {
  if (event.currentTarget.classList.contains("closed")) {
    event.currentTarget.classList.remove("closed");
  } 
}

function clickBtn(event) {
  if (event.currentTarget.classList.contains("clicked")) {
    event.currentTarget.classList.remove("clicked");
  } else {
    event.currentTarget.classList.add("clicked");
  }
}