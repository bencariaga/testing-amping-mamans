document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('editUpdateBtn');
    const tariffInputs = document.querySelectorAll('.tariff-input');
    const rangeInputs = document.querySelectorAll('.range-input');
    const form = document.getElementById('tariffForm');
    const sortForm = document.getElementById('sortForm');
    const sortSelect = document.getElementById('sortSelect');

    btn.addEventListener('click', function () {
        const isEditing = btn.textContent.trim() === 'Edit Data';

        if (isEditing) {
            [...tariffInputs, ...rangeInputs].forEach(i => {
                i.removeAttribute('readonly');
                i.dataset.originalValue = i.value;
            });
            btn.textContent = 'Update Data';
            btn.setAttribute('button', 'Update Data');
            btn.classList.replace('btn-primary', 'btn-success');
        } else {
            form.submit();
        }
    });

    if (sortSelect) {
        sortSelect.addEventListener('change', function () {
            sortForm.submit();
        });
    }
});