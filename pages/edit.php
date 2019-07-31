<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_once __DIR__ . '/../php-functions/auth_functions.php';
  include __DIR__ . "/../pages/header.php";
  require_login();

$patch_id = rawurlencode($_GET['id']);

if(!$patch_id){
  header("location: select.php");
}
// $_SESSION['patch_id'] = $patch_id;
$user_ident = $_SESSION['id'];

$sql = "SELECT * FROM patches WHERE patch_id = ? LIMIT 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$patch_id]);
$JSON_patch_data = $stmt->fetch();

$full_patch_JSON = $JSON_patch_data['full_patch_JSON'];
$full_camera_patch_JSON = $JSON_patch_data['camera_patch'];
$job_name = $JSON_patch_data['job_name'] ?? '';
$facility = $JSON_patch_data['facility'] ?? '';
$company = $JSON_patch_data['company'] ?? '';
$client = $JSON_patch_data['client'] ?? '';
echo "<script> ";
echo "const data = " . $full_patch_JSON . "; ";
echo "var cameraData = " . $full_camera_patch_JSON . "; ";
echo "</script>";


////////////////////////////////////////////////////////////////////////  
 
//  function getTeam(){
//     global $user_ident;
//     global $db;
//     $sql = "SELECT * FROM team WHERE leader = $user_ident;";
//     $team_result = mysqli_query($db, $sql);
//     return $team_result;
//   }
//   $team = getTeam();

  ///////////////////////////////////////////////////////////////////////

//   function compiledTeam(){
//       global $patch_id;
//       global $db;
//       $sql = "SELECT team FROM patches WHERE patch_id = $patch_id;";
//       $compiled_team_result = mysqli_query($db, $sql);
//       return $compiled_team_result; 
//   }

//   $complied_team_array = compiledTeam();
//   $compiled_team_frmDb = mysqli_fetch_array($complied_team_array);
//   $compiled_team_JSON = $compiled_team_frmDb['team'] ?? '';
//   echo "<script> const compiledTeamJSON = " . $compiled_team_JSON . ";</script>";

?>

<link rel="stylesheet" href="../css/input_fields.css" type="text/css"/>
<div id="job_info">
  <input type = "text" id = "job_name" value="<?php echo $job_name ?>" />
  <input type = "text" id = "facility" value="<?php echo $facility ?>" />
  <input type = "text" id = "company" value="<?php echo $company ?>" />
  <input type = "text" id = "client" value="<?php echo $client ?>" />
</div>

<div class="form_container">
    <form id="tableGen" name="table_gen" class="form">
        <input id="patch_id" style="display:none" type="text" display="hidden" name="patch_id" value="<?php echo $patch_id; ?>" />
        <label>Add Device: </label> <input type="number" name="rows" id="rows" placeholder="Number of i/o" onchange="createTable();" /><br>
        <!-- <input name="generate" type="button" value="Create New Device" onclick='createTable();' /> -->
        <!-- <input type="button" value="Save Patch" onclick="formData();"/> -->
        <!-- below ->create camera table input feilds   -->
      
        <label>Add Cameras: </label><input id="camera_rows" type="number" placeholder="Number of cameras" onchange="cameraTable();" /><br>
        <!-- <button onclick="cameraTable();">Add</button></br> -->
    </form>
    <input id="mainsave" type="button" onclick="formData();" value="Save Patch"/>
</div>

    <!-- the container for all the dynamic tables created by editTable javascript file -->
<div id="container" class="tbl_cont"></div>
<div>
<div id="camera_fromdb_container" class="tbl_cont">
  <table id="cam_tbl" class="cam_tbl"></table>
</div>
<div id="camera_container" class="tbl_cont"></div>
</div>

    <script src="../javascript/editTable.js"></script>
</body>

</html>