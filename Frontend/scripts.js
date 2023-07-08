var logger_container = document.getElementById('sql_logger_inner');
document.getElementById('sql_logger').appendChild(logger_container);

function toggleFilter() {
    var x = document.getElementById("filterbox");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
