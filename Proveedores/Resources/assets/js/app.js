ObtenerLocalizacion();
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
                $('#ciudad').append('<option selected disabled>Seleccione la ciudad</option>');
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
