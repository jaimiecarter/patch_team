//the function that gets input from the html table in edit.php and 
//creates a new table to be saved to the database
function createTable(){
    var rows = document.getElementById('rows').value;
    let inpTable = document.createElement('table');
    let inpTableDiv = document.createElement('div');
    inpTable.setAttribute('id', 'inpTbl');
    inpTable.setAttribute('class', 'patch_tbl');
    //inpTable.setAttribute('border', 1);
    let device = document.createElement('caption');
    //let button = document.createElement('button');
    device.innerHTML='<input id="name" class="name" type="text" placeholder="device" />';
    //button.innerText='Save Patch';
    //button.setAttribute('onclick', 'formData();');
  
    for(i=0; i<rows; i++){
      var row = inpTable.insertRow();
      var cell1 = row.insertCell();
      var cell2 = row.insertCell();
      var cell3 = row.insertCell();
      cell1.setAttribute('class', 'num_col');
      cell1.innerHTML= i+1;
      cell2.innerHTML= '<input class="cell" id="inp" type="text" placeholder="Input" />';
      cell3.innerHTML= '<input class="cell" id="outp" type="text" placeholder="Output" />';
    }
    inpTableDiv.appendChild(inpTable);
    container.appendChild(device);
    container.appendChild(inpTableDiv);
    //container.appendChild(button);
  }
 
  // const data;
  // const data = [
  //   {
  //     name: "deviceOne",
  //     input: ["oneInOne", "oneInTwo", "oneInThree", "oneInFour"],
  //     output: ["oneOutOne", "oneOutTwo", "oneOutThree"]
  //   },
  //   {
  //     name: "deviceTwo",
  //     input: ["twoInOne", "twoInTwo", "twoInThree", "twoInFour"],
  //     output: ["twoOutOne", "twoOutTwo", "twoOutThree", "twoOutFour"]
  //   },
  //   {
  //     name: "deviceThree",
  //     input: ["threeInOne", "threeInTwo", "threeInThree", "threeInFour"],
  //     output: ["threeOutOne", "threeOutTwo", "threeOutThree", "threeOutFour"]
  //   }
  // ];
  
  //the html div where all the tables are displayed
  const container = document.getElementById('container');
  
  //the function that gahters the data from mysql json column and creates the
  //tables to put into the html div
  function tablesFromDb(){
  for (var i = 0;  i < data.length; i++) {
  let div = document.createElement('div');
  let title = document.createElement('caption');
  let table = document.createElement('table');
  let removeTbl = document.createElement('button');
  div.setAttribute('id', 'div'+i); 
  table.setAttribute('id', 'patch_tbl');
  table.setAttribute('class', 'patch_tbl');
  removeTbl.setAttribute('id', i);
  removeTbl.setAttribute('class', 'removetable');
  removeTbl.setAttribute('onclick', 'deleteTable(this.id);');
  removeTbl.innerText = "Delete Device";
  var row = table.insertRow(0);
  row.setAttribute('class', 'header'); 
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = 'No';
  cell2.innerHTML = 'Input';
  cell3.innerHTML = 'Output';
  
  for (var j = 0; j < data[i].input.length; j++) {
    var dataRow = table.insertRow();
    var dataCell1 = dataRow.insertCell();
    var dataCell2 = dataRow.insertCell();
    var dataCell3 = dataRow.insertCell();
    dataCell1.innerHTML = j+1;
    dataCell1.setAttribute('class', 'num_col');
    dataCell2.innerHTML = '<input class="cell" type="text" id="inp" value="'+data[i].input[j]+'" />';
    dataCell3.innerHTML = '<input class="cell" type="text" id="outp" value="'+data[i].output[j]+'" />';
    
  }
  
  title.innerHTML = '<input type="text" class="name" id="name" value="'+data[i].name+'" />';
  
  div.appendChild(title);
  div.appendChild(table);
  div.appendChild(removeTbl);
  container.appendChild(div);
  }
}


if(data === undefined){
  
}else{
  tablesFromDb();
}

  //function that gathers all the tables and puts them into one json file and then 
  //into the database
  function formData(){
    saveCams();
    var patch_id = document.getElementById('patch_id').value;
    var obj = [];
    var gettables = document.querySelectorAll("[class='patch_tbl']");
    var devs = document.querySelectorAll("[class='name']");
    var jobName = document.getElementById('job_name').value;
    var facility  = document.getElementById('facility').value;
    var company = document.getElementById('company').value;
    var client = document.getElementById('client').value;

      for(let i=0;i<gettables.length;i++){
      var devices = devs[i].value;
      var inArray = [];
      var outArray = [];
      devArray = {'name': devices, 'input': inArray, 'output': outArray}
      var tables = gettables[i];
      var inputs = tables.querySelectorAll("[id='inp']");
      var outputs = tables.querySelectorAll("[id='outp']");
      for(let j=0;j<inputs.length;j++){
        allinputs = inputs[j].value;
        inArray.push(allinputs);
      }
      for(let j=0;j<outputs.length;j++){
        alloutputs = outputs[j].value;
        outArray.push(alloutputs);
      }
      obj.push(devArray);
    }
    fullPatch = JSON.stringify(obj);
  
    var processedData = new FormData();
    processedData.append("fullPatch", fullPatch);
    processedData.append("patch_id", patch_id);
    processedData.append("cam_patch", fullCamPatch);
    processedData.append("job_name", jobName);
    processedData.append("facility", facility);
    processedData.append("company", company);
    processedData.append("client", client);

    fetch("../php-functions/JSON_Handler.php", {
      method: "POST",
      body: processedData
  })
  .then(function(){
   window.location = "../pages/show.php?id="+patch_id;
  });
  }
 
  function deleteTable(clicked_id){
    var x = document.getElementById('div'+clicked_id);
    x.parentNode.removeChild(x);
  }

  const cameraContainer = document.getElementById('camera_container');

  function cameraTable(){
  cameraRows = document.getElementById("camera_rows").value;
  cameraTable = document.createElement('table');
  cameraTable.setAttribute('id', 'cam_tbl');
  let cameras = document.createElement('caption');
  //let button = document.createElement('button');
  cameras.innerHTML='<caption>Cameras</caption>';

    for(i=0; i<cameraRows; i++){
      var row = cameraTable.insertRow();
      row.setAttribute('class', 'input_cell');
      var cell1 = row.insertCell();
      var cell2 = row.insertCell();
      var cell3 = row.insertCell();
      cell1.innerHTML= '<input id="cam_no" type="number" class="num_col"  placeholder="No" />';
      cell2.innerHTML= '<input id="cam_inp_one" type="text" class="cell" placeholder="Input 1" />';
      cell3.innerHTML= '<input id="cam_inp_two" type="text" class="cell" placeholder="Input 2" />';
    }
  
   cameraContainer.appendChild(cameras);
   cameraContainer.appendChild(cameraTable);
  }


  function saveCams (){
  var camTbl = document.querySelectorAll("[id='cam_tbl']");
  var camNumber = document.querySelectorAll("[id='cam_no']");
  var camInpOne = document.querySelectorAll("[id='cam_inp_one']");
  var camInpTwo = document.querySelectorAll("[id='cam_inp_two']");
  var camNumberArray = [];
  var camInpOneArray = [];
  var camInpTwoArray = [];
  var camArray = {'cam_no': camNumberArray, 'cam_inp_one': camInpOneArray, 'cam_inp_two': camInpTwoArray};
  for(let k=0; k<camNumber.length; k++){
    allCams = camNumber[k].value;
    camNumberArray.push(allCams);
  }
  for(let k=0; k<camInpOne.length; k++){
    allInpOne = camInpOne[k].value;
    camInpOneArray.push(allInpOne);
  }
  for(let k=0; k<camInpTwo.length; k++){
    allInpTwo = camInpTwo[k].value;
    camInpTwoArray.push(allInpTwo);
  }
  if(camNumberArray === undefined || camNumberArray.length == 0){
    fullCamPatch = JSON.stringify('');
    console.log('cam number array is empty');
  } else {
  fullCamPatch = JSON.stringify(camArray);
  }
  //console.log(camTbl);
}

// populates the camera table from page load
const camFromDbTbl = document.getElementById('camera_fromdb_container');
if(cameraData.length == 0){
 // console.log("cam data is o");
} else { 
// fetch("../php-functions/update_cams_out.php")
// .then(function(response){
//     response.json().then(function(compiledCams){
//     console.log(compiledCams+'this');
//     showCameras(compiledCams);
//     })  
//   });
showCameras(cameraData);
}

function showCameras(cameraData) {
  var parsedCamTable = document.getElementById('cam_tbl');
  var parsedCamCaption = document.getElementById('cam_name');
  table = document.createElement('table');
  table.setAttribute('id', 'cam_tbl');
  table.setAttribute('class', 'table');
  cameraCaption = document.createElement('caption');
  cameraCaption.setAttribute('id', 'cam_name');
  cameraCaption.innerHTML = "<caption>Cameras</caption>";
  var headerRow = table.insertRow();
  headerRow.setAttribute('class', 'header');
  var camH = headerRow.insertCell(0);
  var inOne = headerRow.insertCell(1);
  var inTwo = headerRow.insertCell(2);
  var emptyHeader = headerRow.insertCell(3);
  camH.innerText = "Cam";
  inOne.innerText = "Input 1";
  inTwo.innerText = "Input 2";
  emptyHeader.innerText = "";
  for(i=0; i<cameraData.cam_no.length; i++){
  row = table.insertRow();
  row.setAttribute('id', 'cam_row'+i);
  var camNum = row.insertCell();
  var inpOne = row.insertCell();
  var inpTwo = row.insertCell();
  var button = row.insertCell();
  camNum.setAttribute('class', 'num_col');
  camNum.innerHTML = "<input class='cam_col' id = 'cam_no' name = 'cam_number' value = " + cameraData.cam_no[i] + " />";
  inpOne.innerHTML = "<input class='cell' id= 'cam_inp_one' value = " + cameraData.cam_inp_one[i] + " />";
  inpTwo.innerHTML = "<input class='cell' id='cam_inp_two' value = " + cameraData.cam_inp_two[i] + " />";
  button.innerHTML = "<input class='remove' type='button' value='Remove' onclick='removeCamera(this);' />"

  }
 // table.appendChild(cameraCaption);
  camFromDbTbl.replaceChild(table, parsedCamTable);
}

function removeCamera(button){
  var camRow = button.parentNode.parentNode;
  camRow.parentNode.removeChild(camRow);

  var updatedCamNum = document.querySelectorAll("[id='cam_no']");
  var updatedInpOne = document.querySelectorAll("[id='cam_inp_one']");
  var updatedInpTwo = document.querySelectorAll("[id='cam_inp_two']");

  //var updatedCamArray = [];
  var cam = [];
  var iOne = [];
  var iTwo = [];
  var camArray = {'cam_no': cam, 'cam_inp_one': iOne, 'cam_inp_two': iTwo};
  numOfCams = document.querySelectorAll("[name='cam_number']");
  for(var i=0; i<numOfCams.length; i++){
    allCams = updatedCamNum[i].value;
    cam.push(allCams);

    alliOne = updatedInpOne[i].value;
    iOne.push(alliOne);

    alliTwo = updatedInpTwo[i].value;
    iTwo.push(alliTwo);
    
  }

  
  fullCamPatch = JSON.stringify(camArray);
  //console.log(patch_id.value);


  var appendedCams = new FormData();
  appendedCams.append("cam_patch", fullCamPatch);
  appendedCams.append("patch_id", patch_id.value);
  fetch("../php-functions/update_cams_in.php", {
      method: "POST",
      body: appendedCams
  });
//  return fetch("../php-functions/update_cams_out.php")
//   .then(function(response){
//     response.json().then(function(){
    
//     //showCameras(compiledCams);
//     })  
// });
}


