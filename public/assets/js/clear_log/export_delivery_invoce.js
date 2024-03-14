function exportDeliveryInvoice() {
    alert('sdf');
    var table = document.getElementById("cliTbl");
    var rows = [];
    rows.push([
        '#',
        'Invoice No.',
        'Container',
        'Company Name',
        'Status',
        'Delivery Charges',
        'Payment Method',
        'Payment Received',
        'Payment Date',
        'Evidence',
        'Description',
        'Bolading No.',
        'ETA',
    ]);
    for (var i = 0, row; row = table.rows[i]; i++) {
        no = row.cells[0].innerText;
        invoice_no = row.cells[2].innerText;
        container = row.cells[3].innerText;
        company_name = row.cells[4].innerText;
        status = row.cells[5].innerText;
        delivery_charges = row.cells[8].innerText;
        paymeent_method = row.cells[9].innerText;
        payment_received = row.cells[10].innerText;
        payment_date = row.cells[11].innerText;
        evidence = row.cells[12].innerText;
        description = row.cells[13].innerText;
        bn = row.cells[14].innerText;
        eta = row.cells[15].innerText;
        rows.push([
            no,
            invoice_no,
            container,
            company_name,
            status,
            delivery_charges,
            paymeent_method,
            payment_received,
            payment_date,
            evidence,
            description,
            bn,
            eta
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
    link.setAttribute("download", "Delivery_invoice.csv");
    document.body.appendChild(link);
    link.click();
}
function test() {
    alert('sfd');
}