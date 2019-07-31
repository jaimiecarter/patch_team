<?php
require_once __DIR__ . '/php-functions/database.php';
require_once __DIR__ . '/php-functions/functions.php';
require_once __DIR__ . '/php-functions/auth_functions.php';
require __DIR__ . '/team-access-header.php';

function delete(){
  global $pdo;
  $token = urlencode($_GET['token']);
  $sql = "DELETE FROM team_tokens WHERE team_token = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$token]);
}

$hdr_tkn = urlencode($_GET['token']);

$sql = "SELECT * FROM team_tokens WHERE team_token = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$hdr_tkn]);
$id_frm_db = $stmt->fetch();

$patch_id = $id_frm_db['patch_id'];

$db_time = $id_frm_db['expire'];
$db_expire_time = strtotime($db_time);
$current_time = time();

if ($current_time > $db_expire_time){
 // delete();
}

if(isset($patch_id)){
  tables();
} else {
  echo "<h4 class='no_access'>You don't have access!</h4>";
}

function tables(){
  global $patch_id;
  global $pdo;
  $sql = "SELECT * FROM patches WHERE patch_id = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$patch_id]);
  $result = $stmt->fetch();
  return $result;
}
  $JSON_patch_data = tables();
  $full_patch_JSON = $JSON_patch_data['full_patch_JSON'] ?? '';
  $full_camera_JSON = $JSON_patch_data['camera_patch'] ?? '';
  $job_name = $JSON_patch_data['job_name'] ?? '';
  $facility = $JSON_patch_data['facility'] ?? '';
  $job_date = $JSON_patch_data['date'] ?? '';

  echo "<script>";
  echo "const data = " . $full_patch_JSON . ";";
  echo "var cameraData = " . $full_camera_JSON . ";";
  echo "</script>";

?>


<input id="patch_id" type="hidden" name ="patch_id" value="<?php echo $patch_id ?>" />
<h3><?php echo $job_name . "   " . $job_date ?></h3>
<h4><?php echo $facility ?></h4>
<!-- the container for all the dynamic tables created by editTable javascript file -->
<div class="patch_table_container" id="container"></div>
<div class="patch_table_container" id="camera_fromdb_container"></div>


<script src='../javascript/teamTable.js'>
</script>
</body>

</html> 