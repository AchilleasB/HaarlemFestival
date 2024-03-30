document.addEventListener("DOMContentLoaded", function () {
    initializeTinyMCE();

    const radioButtons = document.querySelectorAll('input[name="editOption"]');
    const editContainers = document.querySelectorAll('.edit-form-container');

    radioButtons.forEach(function (button) {
        button.addEventListener('change', function () {
            const value = this.value;
            editContainers.forEach(function (container) {
                container.style.display = 'none';
            });
            if (value === 'overview') {
                document.getElementById('editEventContainer').style.display = 'none';
                document.getElementById('editOverviewContainer').style.display = 'block';
            } else {
                document.getElementById('editEventContainer').style.display = 'block';
                document.getElementById('editOverviewContainer').style.display = 'none';
            }
        });
    });
});

function initializeTinyMCE() {
    var fields = document.querySelectorAll('.tinymce-field');
    fields.forEach(function(field) {
        tinymce.init({
            selector: '#' + field.id,
            plugins: 'autolink lists link',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
            height: 300,
            content_css: "../festivalStyle.css"

        });
    });
}
