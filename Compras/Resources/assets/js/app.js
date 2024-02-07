
$('#proveedor').change(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '/GetProveedor/' + this.value,
        data: {
            _token: $('input[name="_token"]').val()
        },
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function () {
            $('#ProveedorUpdate').append("Actualizando...");
        },
        success: function (response) {
            $('#TipoProducto').append(`<option value="${response}">${response}</option>`);
        },
        error: function (xhr, status, error) {
            if (status === 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
            }
            alert("Ocurrió un error. Vuelva a intentarlo.", error);
        },
        complete: function () {
            $('#ProveedorUpdate').empty();
        },
        timeout: 5000
    });
});

$("input[data-type='currency']").keyup(function (e) {
    e.preventDefault();
    formatCurrency($(this));
});

$("input[data-type='currency']").blur(function (e) {
    e.preventDefault();
    formatCurrency($(this), "blur");
});

$('#cantidad').on('input', function () {
    if (this.value === '') {
        $total.val("");
        $('#currency-field').val("");
    } else {
        var precio = $('#currency-field').val().replace(/[$,]/g, "").replace(".00", "");
        formatCurrencyTotal(this.value, precio);
    }
});

$('#Descuento').on('input', function () {
    let precio = $('#currency-field').val().replace(/[$,]/g, "").replace(".00", "");
    let cantidad = $('#cantidad').val();

    let total = cantidad * precio;

    let descuent = (total * this.value) / 100;

    let totalConDescuento = total - descuent;

    $('#total').val("");

    let ValorDescuento = totalConDescuento.toLocaleString("en-US", {
        style: "currency",
        currency: "USD"
    });

    $('#total').val(ValorDescuento);
});

function formatCurrency(input, blur) {
    let input_val = input.val();

    if (input_val === "") {
        return;
    }

    const original_len = input_val.length;
    const caret_pos = input.prop("selectionStart");
    const decimal_pos = input_val.indexOf(".");

    let left_side = "";
    let right_side = "";

    if (decimal_pos >= 0) {
        left_side = formatNumber(input_val.substring(0, decimal_pos));
        right_side = formatNumber(input_val.substring(decimal_pos));

        if (blur === "blur") {
            right_side += "00";
        }

        right_side = right_side.substring(0, 2);

        input_val = `$${left_side}.${right_side}`;
    } else {
        input_val = formatNumber(input_val);
        input_val = `$${input_val}`;

        if (blur === "blur") {
            input_val += ".00";
        }
    }

    input.val(input_val);

    const updated_len = input_val.length;
    const new_caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(new_caret_pos, new_caret_pos);
}

function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrencyTotal(cantidad, precio) {
    const total = (cantidad * precio).toLocaleString("en-US", {
        style: "currency",
        currency: "USD"
    });
    $('#total').val(total);
}
