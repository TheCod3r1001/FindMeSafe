const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const takePhotoButton = document.getElementById('take-photo');
const retakePhotoButton = document.getElementById('retake-photo');
const sendPhotoButton = document.getElementById('send-photo');

navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        video.srcObject = stream;
    })
    .catch(err => {
        console.error("Error accessing the camera: " + err);
    });

function takePhoto() {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    video.style.display = 'none';
    canvas.style.display = 'block';
    takePhotoButton.style.display = 'none';
    retakePhotoButton.style.display = 'inline-block';
    sendPhotoButton.style.display = 'inline-block';
}

function retakePhoto() {
    video.style.display = 'block';
    canvas.style.display = 'none';
    takePhotoButton.style.display = 'inline-block';
    retakePhotoButton.style.display = 'none';
    sendPhotoButton.style.display = 'none';
}

function sendPhoto() {
    const ecid = new URLSearchParams(window.location.search).get('ecid');
    if (!ecid) {
        alert("ECID is missing from the URL parameters.");
        return;
    }

    const imageData = canvas.toDataURL('image/png');
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'save_image.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.status === 200) {
            alert('Photo saved successfully.');
            window.location.href = "/";
        } else {
            alert('Error saving photo.');
        }
    };
    xhr.send('image=' + encodeURIComponent(imageData) + '&ecid=' + encodeURIComponent(ecid));
}
