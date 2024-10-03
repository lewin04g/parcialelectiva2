document.addEventListener('DOMContentLoaded', function () {
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');
    const deleteButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const pedidoId = this.getAttribute('data-id');
            confirmDeleteButton.setAttribute('data-id', pedidoId);
        });
    });

    confirmDeleteButton.addEventListener('click', function () {
        const pedidoId = this.getAttribute('data-id');
        const form = document.getElementById(`delete-form-${pedidoId}`);
        if (form) {
            form.submit();
        }
    });
});