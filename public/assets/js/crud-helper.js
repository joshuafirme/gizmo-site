    $(document).ready(function () {

        $(document).on('input', '.slug-source', function () {
            const $modal = $(this).closest('.modal');
            const slug = $(this).val()
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');
            $modal.find('.slug-target').val(slug);
        });

        $(document).on('click', '[data-role="fill-modal"]', function () {
            const $trigger = $(this);
            const targetModal = $trigger.data('bs-target');
            const $modal = $(targetModal);
            const $form = $modal.find('form');
            const mode = $trigger.data('mode'); // 'create' or 'edit'
            const data = $trigger.data();

            // 1. Reset Form & Clear Errors
            $form.trigger('reset');
            $modal.find('.is-invalid').removeClass('is-invalid');
            $modal.find('.dynamic-text').text('');

            // 2. Dynamic Title & Button UI
            if (mode === 'edit') {
                $modal.find('.modal-title').html(
                    `<i class="fa-solid fa-pen-to-square"></i> Edit ${data.module || 'Item'}`);
                $modal.find('button[type="submit"]').text('Update Changes').removeClass('btn-success')
                    .addClass('btn-primary');

                // Logic for Laravel/Rails/etc. that require _method spoofing
                if ($form.find('input[name="_method"]').length === 0 && data.method) {
                    $form.prepend(`<input type="hidden" name="_method" value="${data.method}">`);
                }
            } else {
                $modal.find('.modal-title').html(
                    `<i class="fa-solid fa-plus"></i> Add New ${data.module || 'Item'}`);
                $modal.find('button[type="submit"]').text('Save Item').removeClass('btn-primary')
                    .addClass('btn-success');
                $form.find('input[name="_method"]').remove();
            }

            // 3. Set Action URL
            $form.attr('action', $trigger.data('action'));

            // 4. Populate Inputs (Only if in edit mode)
            if (mode === 'edit') {
                console.log('data',data)
                Object.keys(data).forEach(key => {
                    let $field = $modal.find(`[name="${key}"], #${key}`);
                    if ($field.length) {
                        if ($field.is(':checkbox')) {
                            $field.prop('checked', !!data[key]);
                        } else {
                            $field.val(data[key]);
                            console.log(data[key])
                        }
                    }
                });
            }
        });

        $(document).on('click', '.delete-btn', function () {
            const $btn = $(this);
            const url = $btn.data('url');
            const itemName = $btn.data('name') || 'this item';
            const token = $btn.data('token');

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${itemName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create a dynamic form and submit it
                    const $tempForm = $('<form>', {
                        'action': url,
                        'method': 'POST'
                    }).append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': token
                    })).append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));

                    // Show loading state on the clicked button
                    $btn.prop('disabled', true).html(
                        '<i class="fa-solid fa-spinner fa-spin"></i>');

                    // Add to body and submit
                    $('body').append($tempForm);
                    $tempForm.submit();
                }
            });
        });
    });
