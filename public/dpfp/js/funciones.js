//Has configurado un dominio, usa: { get_path(document.domain) }
//No has configurado un dominio, usa { get_path('public') }
//Para obtener la ruta raiz del sitio

function get_path(str_limit) {
    var path = jQuery(location).attr('origin') + "" + jQuery(location).attr('pathname');
    index = path.indexOf(str_limit);
    path = path.substring(0, index + str_limit.length)
    return path.toString();
}


if (get_path("finger-list").includes("finger-list")) {
    setInterval(getFingerprintByUser, 1500);
}

if (get_path("verify-users").includes("verify-users")) {
    activeSensorRead(false);
    getData();
}

function srnPc() {
    var d = new Date();
    var dateint = d.getTime();
    var letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var total = letters.length;
    var keyTemp = "";
    for (var i = 0; i < 6; i++) {
        keyTemp += letters[parseInt((Math.random() * (total - 1) + 1))];
    }
    keyTemp += dateint;
    return keyTemp;
}

jQuery('body').on('click', '.create_token', function () {
    if (!localStorage.getItem("srnPc")) {
        localStorage.setItem("srnPc", srnPc());
        Swal.fire({
            icon: 'success',
            title: 'Generated Token..!',
            text: 'Token: ' + localStorage.getItem("srnPc")
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'The Generated Token is:',
            text: localStorage.getItem("srnPc")
        });
    }
});

function activeSensorRead(showMessage) {
    if (!localStorage.getItem("srnPc")) {
        Swal.fire({
            icon: 'warning',
            width: 400,
            title: '<h5 style="font-size: 20px;">Aún no se ha generado un token para este navegador..!</h5>',

        });
    } else {
        jQuery(".imgFinger").attr("id", localStorage.getItem("srnPc"));
        jQuery(".txtFinger").attr("id", localStorage.getItem("srnPc") + "_texto");
        jQuery(".u_nombre").attr("id", localStorage.getItem("srnPc") + "_name");
        jQuery(".u_identificacion").attr("id", localStorage.getItem("srnPc") + "_identifier");
        var token = jQuery("meta[name='csrf-token']").attr("content");
        var data = new FormData();
        data.append("_token", token);
        data.append("token_pc", localStorage.getItem("srnPc"));
        jQuery.ajax({
            type: 'POST',
            url: get_path("public") + "/active_sensor_read",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (!response.code) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error activando el lector..!',
                        text: "Ha ocurrido un error activando el lector."
                    });
                } else {
                    if (showMessage) {
                        Swal.fire({
                            position: 'top-end',
                            icon: "success",
                            title: "Sensor Activado",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                }
            }
        });
    }
}

jQuery('body').on('click', '.add_finger', function () {
    Swal.fire({
        title: 'Seleccione el nombre del dedo',
        input: 'select',
        inputOptions: {
            'Seleccione': 'Seleccione',
            "Dedos Mano Derecha": {
                Pulgar_Derecho: 'Pulgar',
                Indice_Derecho: 'Indice',
                Corazon_Derecho: 'Corazon',
                Anular_Derecho: 'Anular',
                Meñique_Derecho: 'Meñique'
            },
            "Dedos Mano Izquierda": {
                Pulgar_Izquierdo: 'Pulgar',
                Indice_Izquierdo: 'Indice',
                Corazon_Izquierdo: 'Corazon',
                Anular_Izquierdo: 'Anular',
                Meñique_Izquierdo: 'Meñique'
            },
        },
        showCancelButton: true,
        inputValidator: (value) => {
            return new Promise((resolve) => {
                if (value !== 'Seleccione') {
                    var token = jQuery("meta[name='csrf-token']").attr("content");
                    var data = new FormData();
                    data.append("_token", token);
                    data.append("token_pc", localStorage.getItem("srnPc"));
                    data.append("person_id", jQuery(this).data('id'));
                    data.append("finger_name", value);
                    jQuery.ajax({
                        type: 'POST',
                        url: get_path("public") + "/active_sensor_enroll",
                        data: data,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function (response) {
                            if (!response.code) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error activando el lector..!',
                                    text: "Ha ocurrido un error activando el lector."
                                });
                            }
                        }
                    });
                    resolve();
                } else {
                    resolve('Debes seleccionar un dedo..!');
                }
            });
        }
    });
});

function getFingerprintByUser() {
    var userId = jQuery(".add_finger").data("id");
    var _url = get_path("public") + "/users/" + userId + "/finger-list";
    jQuery.get(get_path("public") + "/get-finger/" + userId, function (data) {
        if (data.length > 0) {
            window.location = _url;
        }
    });
}


//verificar check in o check out
function getData() {
    if (typeof (EventSource) !== 'undefined') {
        var source = new EventSource(get_path("public") + '/api/ssejs/' + localStorage.getItem("srnPc"));
        source.onmessage = function (event) {
            
            const data = JSON.parse(event.data);
            if (data.image !== null) {
                jQuery("#" + localStorage.getItem("srnPc") + "_name").text(data.name);
                jQuery("#" + localStorage.getItem("srnPc")).attr("src", "data:image/png;base64," + data.image);
                if (data.person_id != null) {
                    /* console.log('id',data.person_id) */
                    jQuery("#" + localStorage.getItem("srnPc") + "_identifier").text("User Id: " + data.person_id);
                    /* jQuery("#" + localStorage.getItem("srnPc") + "_texto").text("Usuario verificado"); */
                    jQuery("#" + localStorage.getItem("srnPc") + "_texto").text(data.text);
                    icono = "success";
                    Swal.fire({
                        position: 'top-end',
                        icon: icono,
                        title: data.text,
                        showConfirmButton: false,
                        timer: 3000
                    });

                } else {
                    /* console.log('Message received:', event.data);
                    console.log('El id de la persona no se encontró') */
                    jQuery("#" + localStorage.getItem("srnPc") + "_identifier").text("User Id: ");
                    jQuery("#" + localStorage.getItem("srnPc") + "_texto").text("El Usuario No existe en la base de datos");
                    icono = "error";
                    Swal.fire({
                        position: 'top-end',
                        icon: icono,
                        title: 'El usuario no existe en la bd',
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }

        };
    } else {
        document.getElementById('result').innerHTML = 'Sorry, your browser does not support server-sent events...';
    }
}


jQuery("body").on('click', '#btn_user_list', function () {
    var token = jQuery("meta[name='csrf-token']").attr("content");
    var data = new FormData();
    data.append("_token", token);
    data.append("token_pc", localStorage.getItem("srnPc"));
    $.ajax({
        type: 'POST',
        url: get_path("public") + "/api/sensor_close",
        data: data,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function (response) {
            if (response.code) {
                console.log("sensor close option");
            }
        }
    });
});