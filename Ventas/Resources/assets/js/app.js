$('#conditionBuy').change(function(e) {
    e.preventDefault();
    var selectedOption = $(this).val();

    if (selectedOption === 'SI') {
        $('#OptionCliente').hide();
        $('#ShowDetailCliente').show();

        // SI ES VERDADERO TODOS LOS CAMPOS SON OBLIGATORIOS
        $('#nit').prop('required', true);
        $('#nombre').prop('required', true);
        $('#correo').prop('required', true);
        $('#telefono').prop('required', true);
        $('#celular').prop('required', true);
        //$('#direccion').prop('required', true);
        $('#producto').prop('required', true);
        $('#country').prop('required', true);
        $('#estado').prop('required', true);
        $('#ciudad').prop('required', true);

    } else {
        $('#OptionCliente').show();
        $('#ShowDetailCliente').hide();
    }
});

$('#PaymentMethodCondition').change(function(e) {
    e.preventDefault();

    var selectedOption = $(this).val();

    var selectedOptionBuy = $('#conditionBuy').val();

    if (selectedOption == 2 && selectedOptionBuy == 'NO') {
        $("#miModal").modal('show');
    }
});

$('#productoVenta').change(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "GetProductos/Detail/sale/"+this.value,
        data: {
            _token: $('input[name="_token"]').val()
        },
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function() {
            $('#DetailProductUpdates').append("Actualizando...");
        },
        success: function(response) {
            $('#DetailProduct').html(response);
            $('#currency-field').prop("disabled", false);
        },
        error: function(xhr, status, error) {
            if (status === 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
            }
            alert("Ocurrió un error. Vuelva a intentarlo.", error);
        },
        complete: function() {
            $('#DetailProductUpdates').empty();
        },
        timeout: 5000
    });
});

$("input[data-type='currency']").keyup(function(e) {
    formatCurrency($(this));
});

$("input[data-type='currency']").blur(function(e) {
    e.preventDefault();
    formatCurrency($(this), "blur");
});


$('#cantidad').on('input', function() {
    if (this.value === '') {

        $('#total').val("")
        $('#currency-field').val("")

    } else {
        var precio = $('#currency-field').val().replace(/[$,]/g, "").replace(".00", "");
        FormatCurrencyTotal(this.value, precio);
    }

});

$('#Descuento').on('input', function() {

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

function FormatCurrencyTotal(cantidad, precio) {

    var result = cantidad * precio;
    let total = result.toLocaleString("en-US", {
        style: "currency",
        currency: "USD"
    });
    $('#total').val(total);

}

$('#createSales').on('show.bs.modal', function(event) {
    ObtenerLocalizacion();
});

function ObtenerLocalizacion() {

    $.ajax({
        type: "get",
        url: "/api/pais",
        dataType: 'json',
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function() {
            $('#updatesCountry').append("Actualizando...");
            $('#direccion').empty();
        },
        success: function(response) {
            $.each(response, function(key, result) {
                $('#country').append($('<option>', {
                    value: result,
                    text: result
                }));
            });
            $('#country').selectpicker('refresh');
        },
        error: function(xhr, status, error) {
            if (status === 'timeout') {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
            }
            alert("Ocurrió un error. Vuelva a intentarlo.", error);
        },
        complete: function() {
            $('#updatesCountry').empty();
        },
        timeout: 5000
    });

    $("#country").change(function(e) {
        e.preventDefault();
        $('#estado').empty();

        $.ajax({
            type: "get",
            url: "/api/estado/" + this.value,
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            beforeSend: function() {
                $('#UpdatesStatus').append("Actualizando...");
                $('#UpdatesStatus').empty();
            },
            success: function(response) {
                $.each(response, function(key, result) {
                    $('#estado').append($('<option>', {
                        value: result,
                        text: result
                    }));
                });
                $('#estado').selectpicker('refresh');
            },
            error: function(xhr, status, error) {
                if (status === 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }
                }
                alert("Ocurrió un error. Vuelva a intentarlo.", error);
            },
            complete: function() {
                $('#UpdatesStatus').empty();
            },
            timeout: 5000
        });
    });

    $("#estado").change(function(e) {
        e.preventDefault();
        $('#ciudad').empty();

        $.ajax({
            type: "get",
            url: "/api/ciudad/" + this.value,
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            beforeSend: function() {
                $('#UpdatesCity').append("Actualizando...");
                $('#direccion').empty();
            },
            success: function(response) {
                $.each(response, function(key, result) {
                    $('#ciudad').append($('<option>', {
                        value: result,
                        text: result
                    }));
                });
                $('#ciudad').selectpicker('refresh');

            },
            error: function(xhr, status, error) {
                if (status === 'timeout') {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        $.ajax(this);
                        return;
                    }
                }
                alert("Ocurrió un error. Vuelva a intentarlo.", error);
            },
            complete: function() {
                $('#UpdatesCity').empty();
            },
            timeout: 5000
        });
    });

    $('#ciudad').change(function(e) {
        e.preventDefault();
        $('#direccion').html(
            "<label>Digite Dirrecion</label><span style='color: red'>*</span><input type='text' name='direccion' class='form-control' required>"
        );
    });
}
