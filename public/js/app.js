document.querySelectorAll('.search-box input').forEach((input) => {
    const rows = input.closest('.data-card').querySelectorAll('tbody tr');

    input.addEventListener('input', () => {
        const query = input.value.trim().toLowerCase();

        rows.forEach((row) => {
            row.hidden = !row.textContent.toLowerCase().includes(query);
        });
    });

    document.querySelectorAll('[data-avatar-upload]').forEach((upload) => {
        const input = upload.querySelector('[data-avatar-input]');
        const label = upload.querySelector('[data-avatar-label]');
        const status = upload.querySelector('[data-avatar-status]');
        const placeholder = upload.querySelector('[data-avatar-placeholder]');
        let preview = upload.querySelector('[data-avatar-preview]');

        const showFile = (file) => {
            if (!file) return;

            if (!file.type.startsWith('image/') || file.size > 2 * 1024 * 1024) {
                status.textContent = 'Please choose an image no larger than 2 MB.';
                status.classList.add('avatar-upload-error');
                input.value = '';
                return;
            }

            status.classList.remove('avatar-upload-error');
            label.textContent = file.name;
            status.textContent = `${(file.size / 1024 / 1024).toFixed(2)} MB · Ready to upload`;

            const reader = new FileReader();
            reader.addEventListener('load', () => {
                if (!preview) {
                    preview = document.createElement('img');
                    preview.dataset.avatarPreview = '';
                    preview.alt = 'Selected profile picture preview';
                    placeholder?.replaceWith(preview);
                }
                preview.src = reader.result;
            });
            reader.readAsDataURL(file);
        };

        upload.addEventListener('click', (event) => {
            if (event.target !== input) input.click();
        });
        input.addEventListener('change', () => showFile(input.files[0]));
        upload.addEventListener('dragover', (event) => {
            event.preventDefault();
            upload.classList.add('is-dragging');
        });
        upload.addEventListener('dragleave', () => upload.classList.remove('is-dragging'));
        upload.addEventListener('drop', (event) => {
            event.preventDefault();
            upload.classList.remove('is-dragging');
            const [file] = event.dataTransfer.files;
            if (file) {
                const transfer = new DataTransfer();
                transfer.items.add(file);
                input.files = transfer.files;
                showFile(file);
            }
        });
    });
});
