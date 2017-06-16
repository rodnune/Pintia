


function filter() {
    // Declare variables
    var input, filter, table, tr, td,td2, i;

    input = $("#myInput");
    filter = input.val();
    table = $("#pagination_table");
    tr = table.find("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 1; i < tr.length; i++) {

        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            if (td.innerHTML.indexOf(filter) > -1) {

                tr[i].style.display = "";

            } else {
                tr[i].style.display = "none";
            }
        }

        td2 = tr[i].getElementsByTagName("td")[0];
        if (td2) {
            if (td2.innerHTML.indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}



