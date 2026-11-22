// 

//This function clears the red border and error message from a field before the form is checked again.
function clearError(id) {
    let field = document.getElementById(id);
    field.classList.remove("error");
    field.setCustomValidity("");
}

//This function adds an error message and styling to a field when the user has not filled it in correctly.
function showError(id, message) {
    let field = document.getElementById(id);
    void field.offsetWidth; //Makes the box animation shake again each time the submit is pressed.
    field.classList.add("error");
    field.setCustomValidity(message);
    field.reportValidity();
}

//Turns an empty field red and plays animation.
function markIfEmpty(id) {
    let field = document.getElementById(id);
    if (field.value.trim() === "") {
        void field.offsetWidth; //Makes the box animation shake again each time the submit is pressed.
        field.classList.add("error");
    }
}

// 
function validateLogin() {
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value;

    clearError("username");
    clearError("password");

    // 
    if (username === "" || password === "") {
        markIfEmpty("username");
        markIfEmpty("password");

        let message = "Please complete this field.";
        if (username === "") {
            showError("username", message);
        } else {
            showError("password", message);
        }
        return false;
    }
    return true;
}

// 
function validateRegister() {
    let username = document.getElementById("username").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;

    clearError("username");
    clearError("email");
    clearError("password");
    clearError("confirm_password");

    // 
    if (username === "" || email === "" || password === "" || confirmPassword === "") {
        markIfEmpty("username");
        markIfEmpty("email");
        markIfEmpty("password");
        markIfEmpty("confirm_password");

        let message = "Please complete this field.";
        if (username === "") {
            showError("username", message);
        } else if (email === "") {
            showError("email", message);
        } else if (password === "") {
            showError("password", message);
        } else {
            showError("confirm_password", message);
        }
        return false;
    }

    // 
    if (document.getElementById("email").checkValidity() === false) {
        showError("email", "Please enter a valid email address, e.g. name@example.com");
        return false;
    }

    // 
    if (password !== confirmPassword) {
        showError("confirm_password", "Your passwords do not match.");
        return false;
    }
    return true;
}

// 
function validateProject() {
    let title = document.getElementById("title").value.trim();
    let startDate = document.getElementById("start_date").value;
    let endDate = document.getElementById("end_date").value;
    let description = document.getElementById("short_description").value.trim();

    clearError("title");
    clearError("start_date");
    clearError("end_date");
    clearError("short_description");

    // 
    if (title === "" || startDate === "" || description === "") {
        markIfEmpty("title");
        markIfEmpty("start_date");
        markIfEmpty("short_description");

        let message = "Please complete this field.";
        if (title === "") {
            showError("title", message);
        } else if (startDate === "") {
            showError("start_date", message);
        } else {
            showError("short_description", message);
        }
        return false;
    }

    // 
    if (endDate !== "") {
        let start = new Date(startDate + "T00:00");
        let end = new Date(endDate + "T00:00");
        if (end < start) {
            showError("end_date", "The end date cannot be before the start date.");
            return false;
        }
    }
    return true;
}