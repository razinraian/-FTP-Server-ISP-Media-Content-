console.log("Connected With JavaScript");


function validateForm() {

    const title = document.getElementById("title").value;

    const description = document.getElementById("description").value;

    const category = document.getElementById("category").value;

    const file = document.getElementById("cfile").value;


    let isValid = true;


    console.log(title, description, category, file);


  

    if (!title) {

        document.getElementById("titleerr").innerHTML = "Enter Title";

        isValid = false;

    }

    else if (title.length < 3) {

        document.getElementById("titleerr").innerHTML = "Title Must Be At Least 3 Characters";

        isValid = false;

    }

    else {

        document.getElementById("titleerr").innerHTML = "";

    }


    

    if (!description) {

        document.getElementById("descriptionerr").innerHTML = "Enter Description";

        isValid = false;

    }

    else if (description.length < 10) {

        document.getElementById("descriptionerr").innerHTML = "Description Must Be At Least 10 Characters";

        isValid = false;

    }

    else {

        document.getElementById("descriptionerr").innerHTML = "";

    }


    

    if (!category) {

        document.getElementById("categoryerr").innerHTML = "Select Category";

        isValid = false;

    }

    else {

        document.getElementById("categoryerr").innerHTML = "";

    }


    

    if (!file) {

        document.getElementById("fileerr").innerHTML = "Select A File";

        isValid = false;

    }

    else {

        document.getElementById("fileerr").innerHTML = "";

    }


    

    return isValid;

}