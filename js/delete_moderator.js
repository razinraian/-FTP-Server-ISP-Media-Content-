function deleteModerator(id) {

    var xttp = new XMLHttpRequest();

    xttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var data = JSON.parse(this.responseText);

            if (data.success) {
                document.getElementById("row-" + id).remove();
            } else {
                alert(data.message);
            }

            console.log(this.responseText);
        }
    };

    xttp.open("GET", "../controllers/ajax_delete_moderator.php?id=" + id, true);
    xttp.send();
}