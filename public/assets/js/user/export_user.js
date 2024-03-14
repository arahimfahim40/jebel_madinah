function exportUser() {
    var table = document.getElementById("usersTBody");
    var rows = [];
    rows.push([
        "No",
        "Name",
        "Email",
        "Type",
        "Time Zone",
        "Status"
    ]);
    for (var i = 0, row; row = table.rows[i]; i++) {
        no = row.cells[0].innerText;
        uname = row.cells[2].innerText;
        email = row.cells[3].innerText;
        type = row.cells[4].innerText;
        timezone = row.cells[5].innerText;
        ustatus = row.cells[6].innerText;
        rows.push([
            no,
            uname,
            email,
            type,
            timezone,
            ustatus
        ]);
    }
    csvContent = "data:text/csv;charset=utf-8,";
    rows.forEach(function(rowArray){
        row = rowArray.join(",");
        csvContent += row + "\r\n";
    });
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "users.csv");
    document.body.appendChild(link);
    link.click();
}