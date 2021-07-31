function del(url) {
    let id = 0;
    id = row_id;

    if (id === 0) {
        swal(
            'Warning',
            'Please select item!',
            'warning'
        );
        return false;
    }

    swal({
        title: 'Do you approve the deletion?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!'
    }).then(function (result) {
        if (result.value) {
            swal({
                title: '<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Please wait...</span>',
                text: 'Loading, please wait...',
                showConfirmButton: false
            });
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "delete",
                url: url,
                data: {
                    'id': id,
                    '_token': CSRF_TOKEN,
                },
                success: function (response) {
                    swal.close();
                    if (response.case === 'success') {
                        $('#row_' + response.id).remove();
                        swal({
                            position: 'top-end',
                            type: response.case,
                            title: response.title,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        swal(
                            response.title,
                            response.content,
                            response.case
                        );
                    }
                }
            });
        } else {
            return false;
        }
    });
}
