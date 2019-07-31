<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_once __DIR__ . '/../php-functions/auth_functions.php';
  $user_ident = $_SESSION['id'];
  require_login();
  include('../pages/header.php');
  $date = date('d/m/y');
    
?>



<link rel="stylesheet" href="../css/create_job.css" type="text/css"/>
    
    <div id="job_info">
        <form name="create_job" method="post" action="../php-functions/create_job_sql.php">
            <input type='number' name="user_ident" style="display: none" value="<?php echo $user_ident ?>">
            <input type="text" name="job_name" placeholder="Job Name"><br />
            <input type="text" name="facility" placeholder="Facility"><br />
            <input type="text" name="company" placeholder="Company"><br />
            <input type="text" name="client" placeholder="Client"><br />
            <input type="submit" value="Create Job" />
            <input style="display: none" id="date" type="text" name="date" value="<?php echo $date; ?>" ><br />
        </form>
    </div>
    <script src="../javascript/createJob.js"></script>
</body>
</html>