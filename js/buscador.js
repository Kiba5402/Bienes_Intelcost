document.getElementById('submitButton').addEventListener('click', (e) => {
    e.preventDefault();
    getFInfo();
});


//funcion que trae la informacion de los select del filtro
function getFInfo() {
    var ajaxI = new XMLHttpRequest();
    let slcCity = document.getElementById('selectCiudad').value;
    let slcTipo = document.getElementById('selectTipo').value;
    let cityV = (slcCity == -1) ? "?cityv=" : "?cityv=" + slcCity;
    let tipoV = (slcTipo == -1) ? "&typev=" : "&typev=" + slcTipo;
    const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/get/` + cityV + tipoV;
    ajaxI.open('GET', urla, true);

    ajaxI.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            renderBf(this.responseText);
        } else if (this.readyState == 4 && this.status == 404) {
            console.log('error');
        }
    }
    //enviamos la peticion
    ajaxI.send();
}

//funcion que nos ayuda a pintar toda la informacion
//de los bienes por pantalla
function renderBf(info) {
    try {
        let infoA = JSON.parse(info);
        if (infoA.length > 0) {
            let div = document.getElementById('divResultadosBusqueda');
            div.innerHTML = "";
            infoA.forEach(bienR => {
                creaObjF(bienR.Direccion, bienR.Ciudad, bienR.Telefono, bienR.Codigo_Postal, bienR.Tipo, bienR.Precio);
            });
        }
    }
    catch (e) {
        console.error('error -->', e);
    }
}

//funcion que nos ayudaa crear un objeto para ser insertado enla pagina
function creaObjF(dir, city, tel, cp, ty, prec) {
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
        `<button>Guardar</button><br></div>`;

    divImg.appendChild(img);
    divP.appendChild(divImg);
    divP.appendChild(divInfo);
    div.appendChild(divP);
}

