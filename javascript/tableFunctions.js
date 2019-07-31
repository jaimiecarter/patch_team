function createInputTable() {
    var num_rows = document.getElementById('rows').value;
    var tableName = document.getElementById('conn_input_device').value;
    var column_number = 2;
    var tdefine = '<form id="form"><table id="table" border = "1">\n';
    var theader = '<tr><th>No</th><th>Input</th><th>Output</th></tr>\n';
    var caption = '<caption><input id="device" value ="' + tableName + '" /></caption>';
    var tbody = '';
    var tfooter = '</table>';
    var createNewDevice = '<button onclick="formData();">Form Data</button></form>'
    var i = 0;

    for (var i = 0; i < num_rows; i++) {
        tbody += '<tr><td>' + (i + 1) + '</td><td><input class="cell" id="i' + i + '" type = "text"/></td>';
        tbody += '<td><input class="cell" id="o' + i + '" type="text"/></td></tr>\n';
    }
    document.getElementById('wrapper').innerHTML = caption + tdefine + theader + tbody + tfooter + createNewDevice;
}

function formData() {
    var cellData = document.getElementsByTagName("tr");
    var obj = [device];
    for (var i = 0; i < cellData.length - 1; i++) {
        obj.push(document.getElementById("i" + i).value);
        obj.push(document.getElementById("o" + i).value);
    }
    alert(JSON.stringify(obj));
}

//below - read from database JSON and create table

var array = "<?php echo $full_patch_JSON; ?>";
//var array = {"Coms Dallis": {"in": ["in1", "in2", "in3"], "out": ["out1", "out2", "out3"]}}
for(var key in array){
    var tableTop = "<table border = 1 ><caption>" + key + "</caption>";
    var tableHeader = "<tr><th>No</th><th>Input</th><th>No</th><th>Output</th>";
    var tbody = '';
    var tableBottom = "</table>";
    var j;
    for (var j = 0; JSON < array[key]['in'].length; j++) {
      tbody += '<tr><td>' + (j + 1) + '</td><td>' + array[key]['in'][j] + '</td>';
      tbody += '<td>' + (j + 1) + '</td><td>' + array[key]['out'][j] + '</td></tr>\n';
}
document.getElementById("container").innerHTML = tableTop + tableHeader + tbody + tableBottom;
}