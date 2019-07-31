<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_once __DIR__ . '/../php-functions/auth_functions.php';
  require __DIR__ . '/header.php';
  require_login();

 $patch_id = rawurlencode($_GET['id']);
 $_SESSION['patch_id'] = $patch_id;

$sql = "SELECT * FROM patches WHERE patch_id = ? LIMIT 1;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$patch_id]);
$JSON_patch_data = $stmt->fetch();  

$full_patch_JSON = $JSON_patch_data['full_patch_JSON'] ?? '';
$full_camera_JSON = $JSON_patch_data['camera_patch'] ?? '';
$job_name = $JSON_patch_data['job_name'] ?? '';
$facility = $JSON_patch_data['facility'] ?? '';
$job_date = $JSON_patch_data['date'] ?? '';

echo "<script>";
echo "const data = " . $full_patch_JSON . ";";
echo "var cameraData = " . $full_camera_JSON . ";";
echo "</script>";

$t = random_bytes(5);
$token = bin2hex($t);


  ?>

    <title>Show Patch</title>
    <link rel="stylesheet" href="../css/table.css" type="text/css"/>

<input id="patch_id" type="hidden" name ="patch_id" value="<?php echo $patch_id ?>" />
<h3><?php echo $job_name . " : " . $job_date ?></h3>
<h4><?php echo $facility ?></h4>

<!-- the container for all the dynamic tables created by editTable javascript file -->
<div class="patch_table_container" id="container"></div>
<div class="patch_table_container" id="camera_fromdb_container"></div>
<div class="submit_cont">
<a class="submit" href="../pages/edit.php?id=<?php echo $patch_id; ?>">Edit this patch</a>
</div>
<div class="submit_cont">
    <form class="submit" >
      <input id="sms_token" type="text" name="team_token" style="display:none" value="<?php echo $token ?>" />
      <input id="sms_patch_id" type="text" name="patch_id" style="display:none" value="<?php echo $patch_id ?>" />
      <a id="smsText" onclick="smsTeam();" value="SMS team">SMS team </a>
    </form>
</div>
    <script src="../javascript/showTable.js">
    </script>
</body>

</html>