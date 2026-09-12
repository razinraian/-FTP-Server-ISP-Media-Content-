function validatePassword()
{
    let currentPassword =
        document.getElementById("currentPassword").value;

    let newPassword =
        document.getElementById("newPassword").value;

    let confirmNewPassword =
        document.getElementById("confirmNewPassword").value;


    if (currentPassword == "")
    {
        alert("Current password is required");
        return false;
    }


    if (newPassword.length < 8)
    {
        alert("New password must be at least 8 characters");
        return false;
    }


    if (newPassword != confirmNewPassword)
    {
        alert("New passwords do not match");
        return false;
    }


    return true;
}