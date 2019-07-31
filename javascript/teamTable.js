const container = document.getElementById('container');

const patch_id = document.getElementById('patch_id').value;

//tables to put into the html div
function tablesFromDb() {
    for (var i = 0; i < data.length; i++) {
        //let div = document.createElement('div');
        let title = document.createElement('caption');
        let table = document.createElement('table');
       // div.setAttribute('id', 'div' + i);
       // table.setAttribute('border', 1);
        table.setAttribute('id', 'tblFrmDb' + i);
        table.setAttribute('class', 'table');
        var row = table.insertRow(0);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        row.setAttribute('class', 'header');
        cell1.innerHTML = 'No';
        cell2.innerHTML = 'Input';
        cell3.innerHTML = 'Output';

        for (var j = 0; j < data[i].input.length; j++) {
            var dataRow = table.insertRow();
            dataRow.setAttribute('class', 'cells');
            var dataCell1 = dataRow.insertCell();
            dataCell1.setAttribute('class', 'num_col');
            var dataCell2 = dataRow.insertCell();
            var dataCell3 = dataRow.insertCell();
            dataCell1.innerHTML = j + 1;
            dataCell2.innerHTML = data[i].input[j];
            dataCell2.setAttribute('class', 'check');
            dataCell2.setAttribute('id', 'dataCellTwo'+i+j);
            dataCell2.setAttribute('onclick', 'checked(this.id);');
            dataCell3.innerHTML = data[i].output[j];
            dataCell3.setAttribute('class', 'check');
            dataCell3.setAttribute('id', 'dataCellThree'+i+j);
            dataCell3.setAttribute('onclick', 'checked(this.id);');

        }

        title.innerHTML = data[i].name;

        // div.appendChild(title);
        // div.appendChild(table);
        // container.appendChild(div);
        container.appendChild(title);
        container.appendChild(table);
    }

}

// below is the function that assigns background colour to cells
function cellCheck(){
var cellStyleFrmDb = [];
var cellIdFrmDb = [];
var y = [];

//console.log(cellCheckData);
for(i=0; i<cellCheckData.length; i++){
    cellIdFrmDb = cellCheckData[i].cell;
    cellStyleFrmDb = cellCheckData[i].check;
    y = document.getElementById(cellIdFrmDb);
    y.style.backgroundColor = cellStyleFrmDb;
 }     
}

const camFromDbTbl = document.getElementById('camera_fromdb_container');
function showCameras() {
    table = document.createElement('table');
    table.setAttribute('class', 'table');
    table.setAttribute('id', 'cam_tbl');
    cameraCaption = document.createElement('caption');
    cameraCaption.setAttribute('id', 'cam_name');
    //cameraCaption.setAttribute('class', 'caption');
    cameraCaption.innerHTML = "<caption>Cameras</caption>";
    var headerRow = table.insertRow();
    headerRow.setAttribute('class', 'header')
    var camH = headerRow.insertCell(0);
    var inOne = headerRow.insertCell(1);
    var inTwo = headerRow.insertCell(2);
    camH.innerText = "Cam";
    inOne.innerText = "Input 1";
    inTwo.innerText = "Input 2";

    for(i=0; i<cameraData.cam_no.length; i++){
        row = table.insertRow();
        row.setAttribute('id', 'cam_row'+i);
        row.setAttribute('class', 'cells');
        var camNum = row.insertCell();
        var inpOne = row.insertCell();
        var inpTwo = row.insertCell();
        camNum.setAttribute('id', 'cNo'+i);
        camNum.setAttribute('onclick', 'checked(this.id);');
        camNum.setAttribute('class', 'num_col');
        camNum.innerHTML = cameraData.cam_no[i];
        inpOne.setAttribute('id', 'inOne'+i);
        inpOne.setAttribute('onclick', 'checked(this.id);');
        inpOne.setAttribute('class', 'check');
        inpOne.innerHTML = cameraData.cam_inp_one[i];
        inpTwo.setAttribute('id', 'inTwo'+i);
        inpTwo.setAttribute('onclick', 'checked(this.id);');
        inpTwo.setAttribute('class', 'check');
        inpTwo.innerHTML = cameraData.cam_inp_two[i];
        
    }
    table.appendChild(cameraCaption);
    camFromDbTbl.appendChild(table);
}




//below is the function that stores the background colours of the table cells
// cellCheckData is the constant from the databse
// function checked(cellId){
//     var allCells = document.getElementsByClassName('check');
//     var clickedCell = document.getElementById(cellId);
//     var checkedStyle = window.getComputedStyle(clickedCell).getPropertyValue('background-color');
//     var unChecked = "rgb(201, 237, 255)";
//     var aaChecked = "rgb(244, 204, 226)";
//     var adChecked = "rgb(195, 255, 248)";
//     var crewId = 'jc';
//     //var allCells = document.getElementsByClassName('check');
//     var checkArray = [];
//     //console.log(cellId);
    
//     //below iterates through the cell background colours
//     if(checkedStyle == unChecked){
//         clickedCell.style.backgroundColor = aaChecked;
//         // var checked = aaChecked;
        
//     } else if (checkedStyle == aaChecked) {
//         clickedCell.style.backgroundColor = adChecked;
//         //  var checked = adChecked;
        
//     } else if (checkedStyle == adChecked){
//         clickedCell.style.backgroundColor = unChecked;
//         // var checked = unChecked;
//     }
    
//     //below gets ALL the cells id and background colour values  and puts
//     //them into the main style array onlick
//     for(i=0; i<allCells.length; i++){
//         var allCellId = allCells[i].id;
//         var allCellStyle = window.getComputedStyle(allCells[i]).getPropertyValue('background-color');
//         var check = {'cell': allCellId, 'check': allCellStyle};
//         checkArray.push(check);
//     }
    
//     var checkArrayJSON = JSON.stringify(checkArray);
    
//     //to the database
//     var processedData = new FormData();
//     processedData.append("checked", checkArrayJSON);
//     processedData.append("patch_id", patch_id);
//     fetch("../php-functions/checked_in.php", {
//         method: "POST",
//         body: processedData
//     });
    
//     //AJAX from the database
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var cellCheckData = this.responseText;
//         }
//     };
//     xmlhttp.open("POST", "../php-functions/checked_out.php", true);
//     xmlhttp.send();
// }





window.onload = tablesFromDb();
//window.onload = showCameras();
//window.onload = cellCheck(); 

 if(cameraData.length == 0){
 } else {
     showCameras();
 }  
// if(cameraData === null){
//     cameraData = '';
// }


