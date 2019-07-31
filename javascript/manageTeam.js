function searchTeam() {
    var input, filter, table, tr, a, i, txtValue;
    input = document.getElementById("teamInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("teamTable");
    tr = table.getElementsByTagName("tr");
    
    for (i = 0; i < tr.length; i++) {
        a = tr[i].getElementsByTagName("input")[0];
        txtValue = a.value || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

// var option = document.getElementsByTagName('option');
// option[0].addEventListener('click', getId);

function deleteRow(id){
    console.log(id);
}

function editRow(id){
    var tr = document.getElementById('row'+id);
    var rowCells = tr.getElementsByTagName('td');
    name = rowCells[0].innerText;
    phone = rowCells[1].innerText;
    email = rowCells[2].innerText;
    rowCells[0].innerHTML="<input type='text' name='first_name' value="+ name +" />";
    rowCells[1].innerHTML="<input type='text' name='phone' value="+ phone +" />";
    rowCells[2].innerHTML="<input type='text' name='email'value="+ email +" />";
    rowCells[3].innerHTML="<input type='button' value='save' />"
    console.log(name);
}
    

