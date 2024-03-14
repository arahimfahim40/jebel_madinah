
function exportClearLog() {
    var table = document.getElementById("cliTbl");
    var rows = [];
    rows.push([
        'No',
        'Invoice No',
        'Clear Log',
        'Company Name',
        'Payment Method',
        'Payment Received',
        'Payment Date',
        'Evidence',
        'Status',
        'Custom Duty',
        'Port Handling',
        'VCC',
        'Transporter Charges',
        'E-Token',
        'Local Service Charges',
        'Bill Of Entry',
        'Other Charges',
        'Wash Fine charges',
        'Repairing Cost Charges',
        'Detention Charges',
        'Demorage Charges',
        'Inspection Charges',
        'Terminal Handling Charges',
        'Delivery Order Charges',
        'Additional Charges',
        'Total',
    ]);
    var no = 0;
    for (var i = 0, row; row = table.rows[i]; i++) {
        invoice_no = row.cells[2].innerText;
        clear_log = row.cells[5].innerText;
        company_name = row.cells[6].innerText;
        paymeent_method = row.cells[7].innerText;
        payment_received = row.cells[8].innerText;
        payment_date = row.cells[9].innerText;
        evidence = row.cells[10].innerText;
        status = row.cells[11].innerText;
        custom_duty = row.cells[14].innerText;
        port_handling = row.cells[15].innerText;
        vcc = row.cells[16].innerText;
        transpoter_charges = row.cells[17].innerText;
        e_token = row.cells[18].innerText;
        lsc = row.cells[19].innerText;
        boe = row.cells[20].innerText;
        oc = row.cells[21].innerText;
        wfc = row.cells[22].innerText;
        rcc = row.cells[23].innerText;
        detention_charges = row.cells[24].innerText;
        demorage_charges = row.cells[25].innerText;
        inspection_charges = row.cells[26].innerText;
        thc = row.cells[27].innerText;
        doc = row.cells[28].innerText;
        addention_charges = row.cells[29].innerText;
        total = row.cells[30].innerText;
        rows.push([
            no = no+1,
            invoice_no,
            clear_log,
            company_name,
            paymeent_method,
            payment_received,
            payment_date,
            evidence,
            status,
            custom_duty,
            port_handling,
            vcc,
            transpoter_charges,
            e_token,
            lsc,
            boe,
            oc,
            wfc,
            rcc,
            detention_charges,
            demorage_charges,
            inspection_charges,
            thc,
            doc,
            addention_charges,
            total
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
    link.setAttribute("download", "Clear_log.csv");
    document.body.appendChild(link);
    link.click();
}