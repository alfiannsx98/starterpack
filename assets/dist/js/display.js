function triggerClick(b) {
    document.querySelector('#profileImage').click();
}

function displayImage(b) {
    if (b.files[0]) {
        var reader = new FileReader();
        reader.onload = function (b) {
            document.querySelector('#profileDisplay').setAttribute('src', b.target.result);
        }
        reader.readAsDataURL(b.files[0]);
    }
}