function mayusculas(e) {
    e.value = e.value.toUpperCase();
}

function minusculas(e) {
    e.value = e.value.toLowerCase();
}

function soloNumeros(e) {
    var key = window.Event ? e.which : e.keyCode;
    return ((key >= 48 && key <= 57) || (key == 8) || (key == 110))
}

function numeros(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo es numérico."
        return false
    }
    status = ""
    return true
}

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false;
    for (var i in especiales) {
        if (key === especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) === -1 && !tecla_especial) {
        return false;
    }
}

function validarCorreo(valor) {
    re = /^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
    if (!re.exec(valor)) {
        alert('Correo no valido');
        document.getElementById("txtCorreo").focus();
        document.getElementById("txtCorreo").value = "";
    }
}

function decimales(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " 1234567890.";
    especiales = "8-37-39-46";

    tecla_especial = false;
    for (var i in especiales) {
        if (key === especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) === -1 && !tecla_especial) {
        return false;
    }
}

function validaCedula(form) {
    var val = "0";
    var cedula = form.txtCedula.value;
    array = cedula.split("");
    num = array.length;
    if (num == 10) {
        total = 0;
        digito = (array[9] * 1);
        for (i = 0; i < (num - 1); i++) {
            mult = 0;
            if ((i % 2) != 0) {
                total = total + (array[i] * 1);
            } else {
                mult = array[i] * 2;
                if (mult > 9)
                    total = total + (mult - 9);
                else
                    total = total + mult;
            }
        }
        decena = total / 10;
        decena = Math.floor(decena);
        decena = (decena + 1) * 10;
        final = (decena - total);
        if ((final === 10 && digito === 0) || (final === digito)) {
            return true;
        } else {
            alert("¡El número de cédula ingresado no es valido!");
            document.getElementById("txtCedula").focus();
            document.getElementById("txtCedula").value = "";
            return false;
        }
    } else {
        alert("El número de cédula contiene 10 dígitos");
        document.getElementById("txtCedula").focus();
        document.getElementById("txtCedula").value = "";
        return false;
    }
};