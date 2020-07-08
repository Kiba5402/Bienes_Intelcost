const protocol = window.location.protocol;
const url = window.location.host;

document.addEventListener("DOMContentLoaded", function () {
  getAllinfo();
  getCityInfo();
  getTipoInfo();

  //funcion escucha del boton de la segunda pestaña que nos traera los bienes
  //guardados por el usuario. recordar que el id de usuario esta seteado en index.js
  document.getElementById('ui-id-2').addEventListener('click', () => {
    getSInfo(idUsr);
  });
});

//funcion que trae toda los bienes guardados por un usuario 
function getSInfo(iduser) {
  var ajaxI = new XMLHttpRequest();
  const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/get/?bienS=${iduser}`;
  ajaxI.open('GET', urla, true);

  ajaxI.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      renderBS(this.responseText);
    } else if (this.readyState == 4 && this.status == 404) {
      console.log('error');
    }
  }
  //enviamos la peticion
  ajaxI.send();
}

//funcion que trae la informacion de los select del filtro
function getCityInfo() {
  var ajaxI = new XMLHttpRequest();
  const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/get/?city`;
  ajaxI.open('GET', urla, true);

  ajaxI.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      renderCity(this.responseText);
    } else if (this.readyState == 4 && this.status == 404) {
      console.log('error');
    }
  }
  //enviamos la peticion
  ajaxI.send();
}

//funcion que trae la informacion de los select del filtro
function getTipoInfo() {
  var ajaxI = new XMLHttpRequest();
  const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/get/?types`;
  ajaxI.open('GET', urla, true);

  ajaxI.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      renderType(this.responseText);
    } else if (this.readyState == 4 && this.status == 404) {
      console.log('error');
    }
  }
  //enviamos la peticion
  ajaxI.send();
}

//funcion renderiza la informaicon de los select
function renderType(info) {
  try {
    let infoA = JSON.parse(info);
    infoA.forEach(tipo => {
      let opt = document.createElement('option');
      let div = document.getElementById('selectTipo');
      opt.innerHTML = tipo;
      opt.setAttribute('value', tipo);
      div.appendChild(opt);
    });
  }
  catch (e) {
    console.error('error -->', e);
  }
}

//funcion renderiza la informaicon de los select
function renderCity(info) {
  try {
    let infoA = JSON.parse(info);
    infoA.forEach(city => {
      let opt = document.createElement('option');
      let div = document.getElementById('selectCiudad');
      opt.innerHTML = city;
      opt.setAttribute('value', city);
      div.appendChild(opt);
    });
  }
  catch (e) {
    console.error('error -->', e);
  }
}

//funcion que trae toda la infromacion de los bienes
//para mostrar por pantalla
function getAllinfo() {
  var ajaxI = new XMLHttpRequest();
  const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/get/`;
  ajaxI.open('GET', urla, true);

  ajaxI.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      renderB(this.responseText);
    } else if (this.readyState == 4 && this.status == 404) {
      console.log('error');
    }
  }
  //enviamos la peticion
  ajaxI.send();
}

//funcion que nos ayuda a pintar toda la informacion
//de los bienes por pantalla
function renderB(info) {
  try {
    let infoA = JSON.parse(info);
    infoA.datos.forEach(bienR => {
      creaObj(bienR.Id, bienR.Direccion, bienR.Ciudad, bienR.Telefono, bienR.Codigo_Postal, bienR.Tipo, bienR.Precio);
    });
  }
  catch (e) {
    console.error('error -->', e);
  }
}

//funcion que nos ayuda a pintar toda la informacion
//de los bienes por pantalla guardados para cierto usuario
function renderBS(info) {
  try {
    let infoA = JSON.parse(info);
    let div = document.getElementById('divResultadosBusquedaUsr');
    div.innerHTML = '';
    infoA.forEach(bienR => {
      creaObjG(bienR.Id, bienR.Direccion, bienR.Ciudad, bienR.Telefono, bienR.Codigo_Postal, bienR.Tipo, bienR.Precio);
    });
  }
  catch (e) {
    console.error('error -->', e);
  }
}

//funcion que trae toda la infromacion de los bienes
//para mostrar por pantalla
function getAllSaveinfo() {
  var ajaxI = new XMLHttpRequest();
  const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/get/`;
  ajaxI.open('GET', urla, true);

  ajaxI.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      renderB(this.responseText);
    } else if (this.readyState == 4 && this.status == 404) {
      console.log('error');
    }
  }
  //enviamos la peticion
  ajaxI.send();
}


//funcion que nos ayudaa crear un objeto para ser insertado enla pagina
function creaObj(idB, dir, city, tel, cp, ty, prec) {
  let divP = document.createElement('div');
  let divImg = document.createElement('div');
  let divInfo = document.createElement('div');
  let img = document.createElement('img');
  let div = document.getElementById('divResultadosBusqueda');

  img.setAttribute('src', 'img/home.jpg');
  img.setAttribute('class', 'imgB');
  divImg.setAttribute('class', 'divImg');
  divInfo.setAttribute('class', 'divInfo');
  divP.setAttribute('class', 'divP tituloContenido card');

  divInfo.innerHTML = `<div><span>Dirección:</span> ${dir}<br>` +
    `<span>Ciudad:</span> ${city}<br>` +
    `<span>Telefono:</span> ${tel}<br>` +
    `<span>Codigo postal:</span> ${cp}<br>` +
    `<span>Tipo:</span> ${ty}<br>` +
    `<span>Precio:</span>${prec}<br>` +
    `<button onClick="guardaBien('${idB}', '${dir}', '${city}', '${tel}', '${cp}', '${ty}', '${prec}')">Guardar</button>` +
    `<br><span id="respSpan${idB}"></span></div>`;

  divImg.appendChild(img);
  divP.appendChild(divImg);
  divP.appendChild(divInfo);
  div.appendChild(divP);
}


//funcion que nos ayudaa crear un objeto para ser insertado enla pagina
function creaObjG(idB, dir, city, tel, cp, ty, prec) {
  let divP = document.createElement('div');
  let divImg = document.createElement('div');
  let divInfo = document.createElement('div');
  let img = document.createElement('img');
  let div = document.getElementById('divResultadosBusquedaUsr');

  img.setAttribute('src', 'img/home.jpg');
  img.setAttribute('class', 'imgB');
  divImg.setAttribute('class', 'divImg');
  divInfo.setAttribute('class', 'divInfo');
  divP.setAttribute('class', 'divP tituloContenido card');

  divInfo.innerHTML = `<div><span>Dirección:</span> ${dir}<br>` +
    `<span>Ciudad:</span> ${city}<br>` +
    `<span>Telefono:</span> ${tel}<br>` +
    `<span>Codigo postal:</span> ${cp}<br>` +
    `<span>Tipo:</span> ${ty}<br>` +
    `<span>Precio:</span>${prec}<br>` +
    `</div>`;

  divImg.appendChild(img);
  divP.appendChild(divImg);
  divP.appendChild(divInfo);
  div.appendChild(divP);
}

