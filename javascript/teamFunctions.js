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
const teamContainer = document.getElementById("compiled_team"); 

function getId(clicked_id){
    var patch_id = document.getElementById('patch_id').value;
    var clicked = document.getElementById(clicked_id);
    var td = clicked.getElementsByTagName('td');
    var name = td[0].innerText;
    var phone = td[1].innerText;
    var email = td[2].innerText;
    clicked.style.backgroundColor = "red";
    values = clicked.innerText;
    teamArray = [];
    var array = {"name": name, "phone": phone, "email": email};
    teamArray.push(array);

    var updatedName = document.getElementsByName('updated_name');
    var updatedPhone = document.getElementsByName('updated_phone');
    var updatedEmail = document.getElementsByName('updated_email');
    
    for(var i=0; i<updatedName.length; i++){
        var name = updatedName[i].innerText;
        var phone = updatedPhone[i].innerText;
        var email =  updatedEmail[i].innerText;
        var updatedTeamArray = {'name': name, 'phone': phone, 'email': email};
        teamArray.push(updatedTeamArray);
    }  
    
    fullTeam = JSON.stringify(teamArray);
    var processedData = new FormData();
    processedData.append("team", fullTeam);
    processedData.append("patch_id", patch_id);
    fetch("../php-functions/team_compile_sql.php", {
        method: "POST",
        body: processedData
    });

team();
}

function removeFromCompile(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    var patch_id = document.getElementById('patch_id').value;
    var updatedName = document.getElementsByName('updated_name');
    var updatedPhone = document.getElementsByName('updated_phone');
    var updatedEmail = document.getElementsByName('updated_email');
    updatedArray = [];
    for(var i=0; i<updatedName.length; i++){
        var name = updatedName[i].innerText;
        var phone = updatedPhone[i].innerText;
        var email =  updatedEmail[i].innerText;
        var updatedTeamArray = {'name': name, 'phone': phone, 'email': email};
        updatedArray.push(updatedTeamArray);
    }   
   updatedFullTeam = JSON.stringify(updatedArray);
   var processedData = new FormData();
   processedData.append("team", updatedFullTeam);
   processedData.append("patch_id", patch_id);
   fetch("../php-functions/team_compile_sql.php", {
        method: "POST",
        body: processedData
   });
    
}

//below is putting the dbdata into the window -compiled is the data from the ajax db return
function compileTeam(compiled){
    
    let tableContainer = document.getElementById('compiled_team_table');
    let table = document.createElement('table');
    table.setAttribute('id', 'compiled_team_table');
    for(var i=0; i<compiled.length; i++){
        var row = table.insertRow();
        var teamName = row.insertCell();
        var teamPhone = row.insertCell();
        var teamEmail = row.insertCell();
        var btn = row.insertCell();
        teamName.setAttribute('name', 'updated_name');
        teamPhone.setAttribute('name', 'updated_phone');
        teamEmail.setAttribute('name', 'updated_email');
        teamName.innerText = compiled[i].name;
        teamPhone.innerText = compiled[i].phone;
        teamEmail.innerText = compiled[i].email;
        btn.innerHTML = '<input type="button" value="Remove" onclick="removeFromCompile(this);"/>'    
    }
    teamContainer.replaceChild(table, tableContainer);
    return;
}

function reset(){

}

//below is getting team data from the patches table in db - compiled is the returned json to use in all tables
//function comipleTeamAJAX(){
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var compiled = JSON.parse(this.responseText);
//             compileTeam(compiled);
//         };
//     }
// xmlhttp.open("GET", "../php-functions/team_compile_out.php", true);
// xmlhttp.send();
document.addEventListener("DOMContentLoaded", team());




function team(){
    fetch("../php-functions/team_compile_out.php")
      .then(function(response){
        response.json().then(function(compiled){
        //console.log(compiled);
        compileTeam(compiled);
        })  
    });
}

