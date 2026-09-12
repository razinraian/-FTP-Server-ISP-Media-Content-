function updateStatus(id, status) {

    var xttp = new XMLHttpRequest();

    xttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var data = JSON.parse(this.responseText);

            if (data.success) {
                document.getElementById("status-" + id).innerHTML = status;
            } else {
                alert(data.message);
            }
        }
    };

    xttp.open("GET", "../controllers/ajax_update_request_status.php?id=" + id + "&status=" + status, true);
    xttp.send();
}