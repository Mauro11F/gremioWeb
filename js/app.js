//  MenuToggle
let toggle = document.querySelector('.toggle');
let sidebar = document.querySelector('.sidebar');
let header = document.querySelector('.header');
let bodyElement = document.body;

toggle.onclick = function() {
   sidebar.classList.toggle('active');
   header.classList.toggle('active');
   bodyElement.classList.toggle('active');
}

// añadir efecto al menu...
let list = document.querySelectorAll(".list");
for (let i = 0; i < list.length; i++) {
   list[i].onclick = function () {
      let j = 0;
      while (j < list.length) {
         list[j++].className = 'list';
      }
      list[i].className = 'list active';
   }
   
}

// Modal Toggle
function login() {
   var blur = document.querySelector('.header');
   var modal = document.querySelector('#popup');
   var modal2 = document.querySelector('#popup2');

   modal.classList.toggle('active');
   modal2.classList.remove('active');
   
   if (modal.classList.contains('active') || modal2.classList.contains('active')) {
      blur.classList.add('blurring');
   }else {
      blur.classList.remove('blurring');
   }

}

// mostrar formulario Login
function formCreate() {
   var modal2 = document.querySelector('#popup2');
   modal2.classList.toggle('active');
   var modal = document.querySelector('#popup');
   modal.classList.remove('active');
}
function formLogint() {
   var modal = document.querySelector('#popup');
   modal.classList.toggle('active');
   var modal2 = document.querySelector('#popup2');
   modal2.classList.remove('active');
}

// popup profile
let profile = document.querySelector('.profile');
let menu = document.querySelector('.menu');
profile.onclick = function () {
   menu.classList.toggle('active');
}


// carrusel script
let slides = document.querySelectorAll('.row');
let index = 0;

function next() {
   slides[index].classList.remove('active');
   index = (index + 1) % slides.length;
   slides[index].classList.add('active');
}

function prev() {
   slides[index].classList.remove('active');
   index = (index - 1 + slides.length) % slides.length;
   slides[index].classList.add('active');
}

// funcion para tajetasPersonales.php
let papel = document.getElementById('tipoPapel');
papel.addEventListener("change", function() {
   
   var tarjeta300gr = document.getElementById('laminado');
   let tipoPapel = papel.value;
   if (tipoPapel === "1") {
      tarjeta300gr.classList.add('active');
   }else {
      tarjeta300gr.classList.remove('active');
   }

});

// funcionamiento de las notificaciones
function closeNoti() {
   
   console.log("Dentro de cerrar Notis");

   let alert = document.querySelector('.alert');
   alert.classList.remove('show');
   alert.classList.add('hide');

}