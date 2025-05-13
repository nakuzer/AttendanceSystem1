document.getElementById('saveBtn').addEventListener('click', function () {
    const confirmSave = confirm('Are you sure you want to save?');
    if (confirmSave) {
        this.textContent = 'Saved';
        alert('Changes saved successfully!');
    }
});