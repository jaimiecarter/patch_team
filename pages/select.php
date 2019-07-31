<?php 
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_once __DIR__ . '/../php-functions/auth_functions.php';
  include __DIR__ . '/header.php';
  require_login();

  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM patches WHERE user_ident = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
?>
<div id="select_page"></div>
<link rel="stylesheet" href="../css/select.css" type="text/css"/>


<div class="tbl_container">
  <table class="table">
    <tr class="header">
      <th id="hide">Select</th><th>Date</th><th>Job</th><th>Facility</th><th id="hide">Company</th>
      <th id="hide">Client</th><th>Select</th>
      <?php while($patch = $stmt->fetch()) { ?> 
      <?php $patch_id = $patch['patch_id'];  ?>
    <tr>
      <td style="display: none"><?php echo $patch['patch_id']; ?></td>
      <td id="hide" class="delete" onclick="deleteJob(<?php echo $patch_id; ?>);" value="<?php echo $patch['patch_id']; ?>">Delete</td>
      <td class="cell"><?php echo $patch['date']; ?></td>
      <td class="cell"><?php echo $patch['job_name']; ?></td>
      <td class="cell"><?php echo $patch['facility']; ?></td>
      <td id="hide" class="cell"><?php echo $patch['company']; ?></td>
      <td id="hide" class="cell"><?php echo $patch['client']; ?></td>
      <td class="submit"><a href = "<?php echo '../pages/show.php?id=' . $patch_id ?>">Load</td>
    </tr>
    <?php } ?>
  </table>
  </div>
  <?php //$_SESSION["patch_id_from_create"] = $patch_id; ?>
  
<p></p>
<script src="../javascript/select.js"></script>
</body>
</html>