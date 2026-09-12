// ============================
// Search Contents (AJAX GET)
// ============================
function searchContents() {

    var keyword = document.getElementById("searchBox").value;

    var xttp = new XMLHttpRequest();

    xttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var data = JSON.parse(this.responseText);

            var html = "";

            if (data.success && data.data.length > 0) {
                for (var i = 0; i < data.data.length; i++) {
                    var content = data.data[i];
                    html += "<div class='content-item'>";
                    html += "<h3>" + content.title + "</h3>";
                    html += "<p>" + content.description + "</p>";
                    html += "<p>Category: " + content.category_name + "</p>";
                    html += "<p>Downloads: " + content.download_count + "</p>";
                    html += "<a href='../controllers/download_control.php?id=" + content.id + "'>Download</a>";
                    html += "</div><hr>";
                }
            } else {
                html = "<p>No content found.</p>";
            }

            document.getElementById("contentList").innerHTML = html;
        }
    };

    xttp.open("GET", "../controllers/ajax_search_contents.php?q=" + encodeURIComponent(keyword), true);
    xttp.send();
}

// ============================
// Request Box Validation
// ============================
function validateRequestForm() {

    var title = document.getElementById("content_title").value;

    if (title == "") {
        alert("Content title is required");
        return false;
    }

    return true;
}

// ============================
// Request Box Submit (AJAX POST) - optional, form works without JS too
// ============================
function submitRequestAjax() {

    var title = document.getElementById("content_title").value;

    if (title == "") {
        alert("Content title is required");
        return false;
    }

    var category = document.getElementsByName("category_requested")[0].value;
    var message = document.getElementsByName("message")[0].value;

    var xttp = new XMLHttpRequest();

    xttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var data = JSON.parse(this.responseText);
            alert(data.message);

            if (data.success) {
                document.getElementById("requestForm").reset();
            }
        }
    };

    xttp.open("POST", "../controllers/ajax_add_request.php", true);
    xttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xttp.send("content_title=" + encodeURIComponent(title) +
              "&category_requested=" + encodeURIComponent(category) +
              "&message=" + encodeURIComponent(message));

    return false; // page reload atkanor jonno
}