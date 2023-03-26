// trigger click on input['file'] instead of picture
function triggerClick() {
  document.querySelector("#fileimage").click();
  document.getElementById("profile_image").style.boxShadow =
    "box-shadow: 0 0 0 5px rgba(255, 255, 255, 0.4)";
}
// load imageinto page
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      document
        .querySelector("#profile_image")
        .setAttribute("src", e.target.result);
      document.getElementById("profile_image").style.opacity = "1";
    };
    reader.readAsDataURL(e.files[0]);
  }
}
/*
Dear male-hackers and female-hackers. The code-section below does not mean there are 
just this little regex checks for you to pass. There are more server-side-checks, so have fun trying to pass through 
the regex with your stinyk SQL-INJECTIONS. Cheers, Stevan ;).
*/
// regex checking input form
let signup = document.getElementById("signup");
if (typeof signup != "undefined" && signup != null) {
  // disable button --> enable after successfull regex-check
  const sendButton = document.getElementById("submit");
  sendButton.disabled = true;
  // at least 8 letters, one special char, one lowercase letter
  const passwordRegex = /^(?=.*[@#$%^&+=-€])(?=.*[A-Z])(?=.*[a-z]).{8,}$/;
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
  const nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*.{3,}$/;

  let username = document.getElementById("username");
  let name = document.getElementById("name");
  let lastname = document.getElementById("lastname");
  let email = document.getElementById("email");
  let password = document.getElementById("password");
  let submit = document.getElementById('submit');

  username.addEventListener("keyup", validateUsername);
  name.addEventListener("keyup", validateName);
  lastname.addEventListener("keyup", validateLastname);
  email.addEventListener("keyup", validateEmail);
  password.addEventListener("keyup", validatePassword);

  submit.addEventListener("click", generateModal);

  function generateModal() {
    console.log("clicked");
    if (sendButton.disabled) {
        PopupEngine.createModal({
          heading: "Sign-up error",
          text: "Some input is missing!",
          buttons: [
            {
              text: "continue",
              closePopup: true,
            },
          ],
        });
    }
  }

  setInterval(() => {
    if (
      validateUsername() &&
      validateName() &&
      validateLastname() &&
      validateEmail() &&
      validatePassword()
    ) {
      // regex check successfull --> button accessed
      sendButton.disabled = false;
    } else {
      sendButton.disabled = true;
    }
  }, 100);

  function validateUsername() {
    let isValid = usernameRegex.test(username.value);

    if (!isValid) {
      username.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      username.style.borderBlockColor = "#1a876667";
      return true;
    }
  }

  function validateName() {
    let isValid = nameRegex.test(name.value);
    if (!isValid) {
      name.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      name.style.borderBlockColor = "#1a876667";
      return true;
    }
  }

  function validateLastname() {
    let isValid = nameRegex.test(lastname.value);
    if (!isValid) {
      lastname.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      lastname.style.borderBlockColor = "#1a876667";
      return true;
    }
  }

  function validateEmail() {
    let isValid = emailRegex.test(email.value);
    if (!isValid) {
      email.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      email.style.borderBlockColor = "#1a876667";
      return true;
    }
  }

  function validatePassword() {
    let isValid = passwordRegex.test(password.value);
    if (!isValid) {
      password.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      password.style.borderBlockColor = "#1a876667";
      return true;
    }
  }
}

// GUEST.php
let guestin = document.getElementById("guestin");
if (typeof guestin != "undefined" && guestin != null) {
  let name = document.getElementById("name");
  let lastname = document.getElementById("lastname");
  let guestID = document.getElementById("guest-id");
  let guestinButton = document.getElementById("guestin-btn");
  let guestIcon = document.getElementById("guest-icon");
  let guestLink = document.getElementById("guest-link");

  name.addEventListener("keyup", validateName);
  lastname.addEventListener("keyup", validateLastName);

  const nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*.{3,}$/;

  let generated = false;
  setInterval(() => {
    if (validateName() && validateLastName()) {
      guestID.value = genrateUniqueGuestID(generated);
      generated = true;
      guestLink.style.pointerEvents = "auto";
      guestIcon.addEventListener("click", simulateClick);
      console.log("added");
    } else {
      generated = false;
      guestLink.style.pointerEvents = "none";
      guestID.value = "";
      guestID.placeholder = "Guest-ID";
      guestIcon.removeEventListener("click", simulateClick);
    }
  }, 200);

  function genrateUniqueGuestID(generated) {
    if (!generated) {
      let prefix =
        "Guest-" +
        name.value.charAt(0).toUpperCase() +
        lastname.value.charAt(0).toUpperCase();
      let suffix = () => {
        return Math.floor((1 + Math.random()) * 0x10000)
          .toString(16)
          .substring(1);
      };
      return prefix + suffix() + "-" + suffix();
    } else {
      return guestID.value;
    }
  }

  function simulateClick() {
    let button = document.getElementById("guestin-btn");
    console.log("click");
    button.click();
  }

  function validateName() {
    let isValid = nameRegex.test(name.value);
    if (!isValid) {
      name.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      name.style.borderBlockColor = "#1a876667";
      return true;
    }
  }

  function validateLastName() {
    let isValid = nameRegex.test(lastname.value);
    if (!isValid) {
      lastname.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      lastname.style.borderBlockColor = "#1a876667";
      return true;
    }
  }
}
let login = document.getElementById("login");
if (typeof login != "undefined" && login != null) {
  const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  const passwordRegex = /^(?=.*[@#$%^&+=-€])(?=.*[A-Z])(?=.*[a-z]).{8,}$/;

  let sendButton = document.getElementById("submit");
  let email = document.getElementById("email");
  let password = document.getElementById("password");

  email.addEventListener("keyup", validateEmail);
  password.addEventListener("keyup", validatePassword);

  setInterval(() => {
    if (validateEmail() && validatePassword()) {
      sendButton.disabled = false;
    } else {
      sendButton.disabled = false;
    }
  }, 200);

  function validateEmail() {
    let isValid = emailRegex.test(email.value);
    if (!isValid) {
      email.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      email.style.borderBlockColor = "#1a876667";
      return true;
    }
  }

  function validatePassword() {
    let isValid = passwordRegex.test(password.value);
    if (!isValid) {
      password.style.borderBlockColor = "#e30a0a77";
      return false;
    } else {
      password.style.borderBlockColor = "#1a876667";
      return true;
    }
  }
}
