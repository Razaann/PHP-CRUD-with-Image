// Mengatur agar saat pemilihan format gambar
// yang akan diupload bisa gambar atau link

document.getElementById('upload-option').addEventListener('change', function() {
    document.getElementById('upload-section').style.display = 'block';
    document.getElementById('url-section').style.display = 'none';
    document.getElementById('img_url').value = '';
});

document.getElementById('url-option').addEventListener('change', function() {
    document.getElementById('upload-section').style.display = 'none';
    document.getElementById('url-section').style.display = 'block';
    document.getElementById('img').value = '';
});