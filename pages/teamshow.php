<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_team_login();
  //require('../pages/header.php');

  $patch_id = $_SESSION['patch_id'];
  
  //echo $patch_id_from_create;
  
  function getJSON_data(){
      global $db;
      global $patch_id;
      $sql = "SELECT full_patch_JSON, checked, camera_patch FROM patches WHERE patch_id = $patch_id;";
      $result = mysqli_query($db, $sql);
      return $result;
    }
    
    $patch_data = getJSON_data();
    $JSON_patch_data = mysqli_fetch_array($patch_data);
    
    $full_patch_JSON = $JSON_patch_data['full_patch_JSON'] ?? '';
    $checked_JSON = $JSON_patch_data['checked'] ?? '';
    $full_camera_JSON = $JSON_patch_data['camera_patch'] ?? '';
    //echo $full_patch_JSON;
    // $jobData = getJobInfo();
    echo "<script>";
    echo "var data = " . $full_patch_JSON . ";";
    echo "var cellCheckData = " . $checked_JSON . ";";
    echo "var cameraData = " . $full_camera_JSON . ";";
    echo "</script>";



  ?>

    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="../css/table.css" type="text/css"/>

<input id="patch_id" type="hidden" name ="patch_id" value="<?php echo $patch_id ?>" />


<!-- the container for all the dynamic tables created by editTable javascript file -->
<div class="patch_table_container" id="container"></div>
<div class="patch_table_container" id="camera_fromdb_container"></div>


    <script src="../javascript/showTable.js">
    </script>
</body>

</html>