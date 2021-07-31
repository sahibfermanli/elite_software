function select_row(row) {
    $('.rows').removeClass("selected_row");
    $('#row_' + row).addClass("selected_row");
    row_id = row;
    //$(".action-btn-disable").css('display', 'block');
}

function close_modal(class_name="modal") {
    $("."+class_name).modal("hide");
}

function form_submit_message(response, reload= true, modal_close = true) {
    if (response.case === 'success') {
        if (modal_close) {
            $('#add-modal').modal('hide');
        }
        swal({
            position: 'top-end',
            type: response.case,
            title: response.title,
            showConfirmButton: false,
            timer: 1500
        });
        if (reload) {
            location.reload();
        }
    }
    else {
        if (response.type === 'validation') {
            let content = response.content;
            let validation_message = '';
            $.each(content, function(index, value)
            {
                if (value.length !== 0)
                {
                    for (let i = 0; i < value.length; i++) {
                        validation_message += value[i] + '\n';
                    }
                }
            });
            swal(
                'Validation error!',
                validation_message,
                'warning'
            );
        } else {
            swal(
                response.title,
                response.content,
                response.case
            );
        }
    }
}
