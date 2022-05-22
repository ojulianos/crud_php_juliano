
function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this item?')) {
        window.location.href = url;
    }
}