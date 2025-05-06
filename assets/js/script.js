const divContainer = document.getElementById('create');

document.getElementById('show-create-box').addEventListener('click', function(e) {
  divContainer.style.display = 'flex';
});

document.getElementById('submit-button').addEventListener('click', function(e) {
  divContainer.style.display = 'none';
});


// Crear funcionalidad de arrastre para elemento crear posts:
dragElement(document.getElementById("create"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    // Verificar si hay elemento header dentro de div, definir como punto de arrastre:
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    // Si no existe, hacer que se arrastre desde cualquier punto:
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // Obtener la posición del mouse:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // Llamar la funcion cuando se mueva el mouse:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // Calcular la nueva posición del mouse:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // Mover el elemento a la posición obtenida:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    // Detener el movimiento cuando se suelte el botón del mouse:
    document.onmouseup = null;
    document.onmousemove = null;
  }
}