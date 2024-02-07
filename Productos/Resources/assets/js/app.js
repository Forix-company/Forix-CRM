$('#producto').change(function (e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "/GetProductos/Detail/name/" + this.value,
        data: {
            _token: $('input[name="_token"]').val()
        },
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function () {
            $('#ProductUpdates').append("Actualizando...");
        },
        success: function (response) {
            $('#ProductHTML').html("<label>Nombre del Producto</label><span style='color: red'>*</span><input type='text' value='" + response + "' name='NombreProducto' class='form-control' required readonly>");
            $('#currency-field').prop("disabled", false);
        },
        error: function (xhr, status, error) {
            if (status === 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
            }
            alert("Ocurrió un error. Vuelva a intentarlo.", error);;
        },
        complete: function () {
            $('#ProductUpdates').empty();
        },
        timeout: 5000
    });

    $.ajax({
        type: "POST",
        url: "/GetProductos/Detail/" + this.value,
        data: {
            _token: $('input[name="_token"]').val()
        },
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function () {
            $('#DetailProductUpdates').append("Actualizando...");
        },
        success: function (response) {
            $('#DetailProduct').append(response);
            $('#currency-field').val($('#PrecioCompra').val()).delay(1000).fadeIn();
            $('#currency-field').prop("disabled", false);
        },
        error: function (xhr, status, error) {
            if (status === 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
            }
            alert("Ocurrió un error. Vuelva a intentarlo.", error);;
        },
        complete: function () {
            $('#DetailProductUpdates').empty();
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


$('#currency-field').on('input', function () {

    let precio = $('#currency-field').val().replace(/[$,]/g, "").replace(".00", "");
    let precioCompra = $('#PrecioCompra').val().replace(/[$,]/g, "").replace(".00", "");

    if (precio < precioCompra) {
        alert("El Precio debe ser mayor al precio de compra");
        $(this).val(precioCompra);
    }

});

function formatCurrency(input, blur) {
    var input_val = input.val();

    if (input_val === "") {
        return;
    }

    var original_len = input_val.length;

    var caret_pos = input.prop("selectionStart");

    if (input_val.indexOf(".") >= 0) {

        var decimal_pos = input_val.indexOf(".");

        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        left_side = formatNumber(left_side);

        right_side = formatNumber(right_side);

        if (blur === "blur") {
            right_side += "00";
        }

        right_side = right_side.substring(0, 2);

        input_val = "$" + left_side + "." + right_side;

    } else {

        input_val = formatNumber(input_val);
        input_val = "$" + input_val;

        if (blur === "blur") {
            input_val += ".00";
        }
    }

    input.val(input_val);

    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
