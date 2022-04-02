function addRow() {

    var table = document.getElementById("showing-table");

    var row = table.insertRow(-1);

    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);
    var cell11 = row.insertCell(10);
    var cell12 = row.insertCell(11);

    cell12.innerHTML = `<ul class="list-inline m-0">
                            <li class="list-inline-item">
                                <button class="btn btn-success btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><span class="bi bi-pencil-square"></span></button>
                            </li>
                            <li class="list-inline-item">
                                <button class="btn btn-danger btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><span class="bi bi-trash-fill"></span></button>
                            </li>
                        </ul>`

    return false;
}