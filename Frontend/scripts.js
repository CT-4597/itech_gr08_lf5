function toggleFilter() {
    var x = document.getElementById("filterbox");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function moveLogger() {
    var logger_container = document.getElementById('sql_logger_inner');
    document.getElementById('sql_logger').appendChild(logger_container);
}

function dsgvo_delete_confirmation() {
  var response = confirm("Möchten sie wirklich ihr Benutzerkonto löschen? Dieser Vorgang kann nicht rückgängig gemacht werden!");
  if (response == true) {
    document.getElementById('dsgvo_form_delete').submit();
  }
}
