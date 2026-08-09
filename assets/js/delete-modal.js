// Waits until the initial HTML document is fully loaded and processed by the browser
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');

    if (!deleteModal) {
        return;
    }

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        // Stores the Id and Name in variables
        const userId = button.getAttribute('data-user-id');
        const userName = button.getAttribute('data-user-name');

        document.getElementById('deleteModalName').textContent = userName;
        // Use it with grave accent because you can insert a variable directly into the string
        document.getElementById('deleteForm').action = `/users/${userId}/delete`;
    });
});