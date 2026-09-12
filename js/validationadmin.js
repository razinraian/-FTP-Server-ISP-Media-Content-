function validateRegistration()
{
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword =
        document.getElementById("confirmPassword").value;
    let role = document.getElementById("role").value;

    if (name == "")
    {
        alert("Name is required");
        return false;
    }

    if (email == "")
    {
        alert("Email is required");
        return false;
    }

    let emailPattern =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email))
    {
        alert("Enter a valid email");
        return false;
    }

    if (password.length < 8)
    {
        alert("Password must be at least 8 characters");
        return false;
    }

    if (password != confirmPassword)
    {
        alert("Passwords do not match");
        return false;
    }

    if (role == "")
    {
        alert("Please select a role");
        return false;
    }

    return true;
}