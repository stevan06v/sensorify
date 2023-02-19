
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
            document.getElementById('profile_image').style.opacity="1";
        }
        reader.readAsDataURL(e.files[0]);
    }
}


// regex checking input form
let signup = document.getElementById('signup');
if(typeof(signup) != "undefined" && signup != null){
    // disable button --> enable after successfull regex-check 
    const sendButton = document.getElementById("submit");
    sendButton.disabled = true;

    // At least 8 characters long
    // Contains at least one lowercase letter
    // Contains at least one uppercase letter
    // Contains at least one digit
    // Contains at least one special character (one of !@#$%^&*()_+)
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;

    // At least 3 characters long
    // At most 16 characters long
    // Contains only alphanumeric characters (letters and numbers) and underscores
    const usernameRegex = /^[a-zA-Z0-9_]{3,16}$/;

    // The address starts with one or more word characters, hyphens, or periods ([\w-\.]+).
    // This is followed by an at sign (@).
    // After the at sign, there is a domain name consisting of one or more groups of word characters or hyphens, separated by periods (([\w-]+\.)+), followed by a top-level domain (TLD) consisting of two to four word characters ([\w-]{2,4}).
    const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    // The name can start with one or more alphabetical characters (^[a-zA-Z]+).
    // The name can have any number of middle names or initials, each separated by a space, hyphen, apostrophe, comma, or period (([',. -][a-zA-Z ])?).
    // The last name is required and can have any number of alphabetical characters ([a-zA-Z]*$).
    const nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

    let username = document.getElementById('username');
    let name = document.getElementById('name');
    let lastname = document.getElementById('lastname');
    let email = document.getElementById('email');
    let password = document.getElementById('password');

    username.addEventListener('keyup', validateUsername);
    name.addEventListener('keyup', validateName);
    lastname.addEventListener('keyup', validateLastname);
    email.addEventListener('keyup', validateEmail);
    password.addEventListener('keyup', validatePassword);

    setInterval(() => {
        if(
            validateUsername() &&
            validateName() &&
            validateLastname() && 
            validateEmail() && 
            validatePassword()
        ){
            // regex check successfull --> button accessed
            sendButton.disabled = false;
        }
    }, 100);
    function validateUsername() {
        let isValid = usernameRegex.test(username.value);
        if(!isValid){
            username.style.borderBlockColor = "#e30a0a77";
            return false;
        }else{
            username.style.borderBlockColor = "#1a876667";
            return true;
        }
    }
    function validateName() {
        let isValid = nameRegex.test(name.value);
        if(!isValid){
            name.style.borderBlockColor = "#e30a0a77";
            return false;
        }else{
            name.style.borderBlockColor = "#1a876667";
            return true;
        }
    }
    function validateLastname() {
        let isValid = nameRegex.test(lastname.value);
        if(!isValid){
            lastname.style.borderBlockColor = "#e30a0a77";
            return false;
        }else{
            lastname.style.borderBlockColor = "#1a876667";
            return true;
        }
    }
    function validateEmail() {
        let isValid = emailRegex.test(email.value);
        if(!isValid){
            email.style.borderBlockColor = "#e30a0a77";
            return false;
        }else{
            email.style.borderBlockColor = "#1a876667";
            return true;
        }
    }
    function validatePassword() {
        let isValid = nameRegex.test(password.value);
        if(!isValid){
            password.style.borderBlockColor = "#e30a0a77";
            return false;
        }else{
            password.style.borderBlockColor = "#1a876667";
            return true;
        }
    }
}