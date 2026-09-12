<?php 
include "../controllers/profileValidationadmin.php"; 
?> 
 
<!DOCTYPE html> 
<html> 
 
<head> 
    <title>Profile</title> 

    <link rel="stylesheet" href="../CSS/styleadmin.css"> 

    <script src="../JS/profileadmin.js"></script> 
</head> 
 
<body> 
 
<div class="container"> 
 
    <h2 class="profile-title">My Profile</h2> 

    <?php 
    if ($success != "") 
    { 
        echo "<p class='success'>$success</p>"; 
    } 

    if ($profileErr != "") 
    { 
        echo "<p class='error'>$profileErr</p>"; 
    } 
    ?> 


    <!-- Profile Information -->
    <div class="profile-card">

        <h3>Profile Information</h3> 

        <form method="POST" class="profile-form"> 

            <label>Name</label> 

            <input type="text" 
                   name="name" 
                   value="<?php echo $name; ?>"> 


            <label>Email</label> 

            <input type="text" 
                   name="email" 
                   value="<?php echo $email; ?>"> 


            <button type="submit" 
                    name="updateProfile"> 
                Update Profile 
            </button> 

        </form> 

    </div>


    <!-- Profile Picture -->
    <div class="profile-card">

        <h3>Profile Picture</h3> 

        <div class="profile-picture-box">

            <?php 
            if (!empty($user["profile_picture"])) 
            { 
                echo "<img class='profile-picture'
                     src='../public/uploads/" . 
                     $user["profile_picture"] . 
                     "'>";
            } 
            else
            {
                echo "<p>No profile picture uploaded.</p>";
            }
            ?> 

        </div>


        <?php 
        if ($pictureErr != "") 
        { 
            echo "<p class='error'>$pictureErr</p>"; 
        } 
        ?> 


        <form method="POST" 
              enctype="multipart/form-data"
              class="profile-form"> 

            <label>Select Profile Picture</label>

            <input type="file" 
                   name="profile_picture"> 

            <button type="submit" 
                    name="uploadPicture"> 
                Upload Picture 
            </button> 

        </form> 

    </div>


    <!-- Change Password -->
    <div class="profile-card">

        <h3>Change Password</h3> 

        <?php 
        if ($passwordErr != "") 
        { 
            echo "<p class='error'>$passwordErr</p>"; 
        } 
        ?> 


        <form method="POST" 
              onsubmit="return validatePassword()"
              class="profile-form"> 

            <label>Current Password</label> 

            <input type="password" 
                   id="currentPassword" 
                   name="currentPassword"> 


            <label>New Password</label> 

            <input type="password" 
                   id="newPassword" 
                   name="newPassword"> 


            <label>Confirm New Password</label> 

            <input type="password" 
                   id="confirmNewPassword" 
                   name="confirmNewPassword"> 


            <button type="submit" 
                    name="changePassword"> 
                Change Password 
            </button> 

        </form> 

    </div>


    <div class="back-link">
        <a href="indexadmin.php">Back to Home</a> 
    </div>
 
</div> 
 
</body> 
</html>