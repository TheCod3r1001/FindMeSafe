document.getElementById('decryptForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var encryptionKey = document.getElementById('encryptionKey').value.trim();
    if (!encryptionKey) {
        alert('Please enter the encryption key.');
        return;
    }

    fetch('encrypted_image.jpg')
    .then(response => response.arrayBuffer())
    .then(buffer => {
        var decryptedData = decryptData(buffer, encryptionKey);
        var blob = new Blob([decryptedData]);
        var imageUrl = URL.createObjectURL(blob);

        var imageContainer = document.getElementById('imageContainer');
        imageContainer.innerHTML = '<img src="' + imageUrl + '" alt="Decrypted Image">';
    })
    .catch(error => {
        console.error('Error fetching the encrypted image:', error);
        alert('Error fetching the encrypted image.');
    });
});

function decryptData(buffer, encryptionKey) {
    var key = new TextEncoder().encode(encryptionKey);
    var decryptedData = null;
    
    try {
        var cipher = new TextDecoder().decode(buffer);
        decryptedData = window.crypto.subtle.decrypt(
            {
                name: "AES-GCM",
                iv: new Uint8Array(12), // The initialization vector should match the one used during encryption
                tagLength: 128
            },
            key,
            cipher
        );
    } catch (error) {
        console.error('Error decrypting the image:', error);
        alert('Error decrypting the image.');
    }

    return decryptedData;
}
