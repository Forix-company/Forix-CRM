$('select[name="MotivoDevolucion"]').change(function (e) {
    e.preventDefault();
    if (this.value == 4) {
        const html = `<label>Adjuntar Soporte</label><span style="color: red">*</span>
        <input type="file" name="SoporteGarantia" class="form-control" accept="application/pdf" required>`;

        $('#SoporteGarantia').append(html);
    }

});

$('#proveedor').change(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '/inventario/devolucion/Ajax/Product/' + this.value,
        data: {
            _token: $('input[name="_token"]').val()
        },
        tryCount: 0,
        retryLimit: 3,
        beforeSend: function () {
            $('#ResponseProductUpdate').append("Actualizando...");
        },
        success: function (response) {
            $('#producto').append(response);
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
            $('#ResponseProductUpdate').empty();
        },
        timeout: 5000
    });
});

$('#producto').change(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: '/inventario/devolucion/Ajax/Detail/' + this.value,
        data: {
            _token: $('input[name="_token"]').val()
        },
        tryCount: 0,
        retryLimit: 3,
        success: function (response) {
            $('#ResponseProductDetail').html(response);
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
        timeout: 5000
    });
});

