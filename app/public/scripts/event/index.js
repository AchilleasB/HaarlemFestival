
function initializeTinyMCE() {
    tinymce.init({
        selector: 'textarea',
        plugins: 'autolink lists link',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link',
        height: 300
    });
}
window.addEventListener('DOMContentLoaded', initializeTinyMCE);

function viewEvent(eventId) {
    const url = `/event?eventId=${eventId}`;
    window.location.href = url;
}
