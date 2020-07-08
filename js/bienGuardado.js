
function guardaBien(idb, dir, city, tel, cod, tp, prec) {

    var data = new FormData();
    data.append("idUsr", idUsr);
    data.append("dir", dir);
    data.append("city", city);
    data.append("tel", tel);
    data.append("cod", cod);
    data.append("tipo", tp);
    data.append("precio", prec);
    data.append("idB", idb);

    var ajaxI = new XMLHttpRequest();
    ajaxI.withCredentials = true;
    const urla = `${protocol}//${url}/pruebaBack/backend/Controller/bienes/post/?guarda`;

    ajaxI.open('POST', urla, true);
    //enviamos la peticion
    ajaxI.send(data);

    ajaxI.onreadystatechange = function () {
        let mesj = document.getElementById('respSpan' + idb);
        if (this.readyState == 4 && this.status == 200) {
            let resp = JSON.parse(this.responseText);
            if (resp[0] == "Bien guardado Correctamente") {
                mesj.innerHTML = "Guardado";
                setTimeout(() => {
                    mesj.innerHTML = "";
                }, 2000);
            } else {
                mesj.innerHTML = "Error";
                setTimeout(() => {
                    mesj.innerHTML = "";
                }, 1000);
            }
        } else if (this.readyState == 4 && this.status == 404) {
            console.log('error');
        }
    }

}