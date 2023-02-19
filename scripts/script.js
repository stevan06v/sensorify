
// trigger click on input['file'] instead of picture
function triggerClick() {
    document.querySelector('#fileimage').click()
    document.getElementById('profile_image').style.boxShadow = "box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.4)";
}

// load imageinto page 
function displayImage(e) {
    if(e.files[0]){
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('#profile_image').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
}