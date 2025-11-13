document.getElementById('formTambahProduk').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const formValues = {};
    
    for (let [key, value] of formData.entries()) {
        formValues[key] = value;
    }
    
    localStorage.setItem('draft_produk', JSON.stringify(formValues));
    alert('Data produk berhasil disimpan!');
});

document.addEventListener('DOMContentLoaded', function() {
    const draftData = localStorage.getItem('draft_produk');
    
    if (draftData) {
        const formValues = JSON.parse(draftData);
        
        for (let key in formValues) {
            const element = document.querySelector(`[name="${key}"]`);
            if (element) {
                element.value = formValues[key];
            }
        }
    }
});