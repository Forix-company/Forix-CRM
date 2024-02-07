$('#login_2fa').change(function (e) {
    e.preventDefault();
    if ($('#login_2fa').val() == 2) {
        $.ajax({
            type: 'POST',
            url: '/2fa/' + $('#user_id').val(),
            data: {
                _token: $('input[name="_token"]').val()
            },
            tryCount: 0,
            retryLimit: 3,
            beforeSend: function () {
                $('#CodeQrStatus').append("Actualizando...");
            },
            success: function (response) {
                $('#showCodeQr').modal('show');
                $('#CodeQr').html(response);
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
                $('#CodeQrStatus').empty();
            },
            timeout: 5000
        });
    } else {
        $('#CodeQr').html('');
    }
});

$('#colorHeader').change(function () {
    var selectedColor = $(this).val();

    $('.logo-header').attr('data-background-color', selectedColor);
});

$('#colorNavbarHeader').change(function () {
    var selectedColor = $(this).val();

    $('.main-header .navbar-header').attr('data-background-color', selectedColor);
});

$('#colorBody').change(function () {
    var selectedColor = $(this).val();

    $('body').attr('data-background-color', selectedColor);

    if (selectedColor == 'dark') {
        $('.panel-header').attr('style', 'background-color: #1a2035');
    } else {
        $('.panel-header').attr('style', 'background-color: #1572e8');
    }
});

$('#colorSidebar').change(function () {
    var selectedColor = $(this).val();

    $('.sidebar').attr('data-background-color', selectedColor);
});
