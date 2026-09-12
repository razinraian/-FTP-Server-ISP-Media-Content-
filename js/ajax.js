function deleteContent(id, button) {

    var confirmDelete = confirm("Are you sure you want to delete this content?");

    if (!confirmDelete) {
        return;
    }

    var xhttp = new XMLHttpRequest();

    xhttp.open("GET", "../controllers/delete_content_task3.php?id=" + id, true);

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

            console.log(this.responseText);

            var data = JSON.parse(this.responseText);

            if (data.success) {

                let row = button.parentElement.parentElement;
                row.remove();

                document.getElementById("deleteMessage").innerHTML = data.message;

            } else {

                document.getElementById("deleteMessage").innerHTML = data.message;

            }

        }
    };

    xhttp.send();
}