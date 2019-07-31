<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_login();
  include __DIR__ . '/header.php';

$user_ident = $_SESSION['id'];

function getTeam(){
    global $user_ident;
    global $db;
    $sql = "SELECT * FROM team WHERE leader = $user_ident;";
    $team_result = mysqli_query($db, $sql);
    return $team_result;
  }
  $team = getTeam();

?>
    <h2>Team</h2><br />

<div>
<p>Add members below:</p>
<form action="../php-functions/team_sql.php" method="post">
<input type="text" name = "firstname" placeholder="First name" /></br>
<input type="text" name = "lastname" placeholder="Last name" /></br>
<input type="tel" name="phone" placeholder="Mobile Number" /></br>
<input type="email" name="email" placeholder="email" /></br>
<input type="submit" /></br> 
</form>
<p>Note: These team members are only stored</br>
in your database and are not publically available</p>
</div>
<div>
    <h4>Your Team</h4>
<input type="text" id="teamInput" onkeyup="searchTeam();" placeholder="Search for names.." title="Type in a name">
    <form id="team_form">   
    <table id="teamTable">
        <?php while($team_members = mysqli_fetch_assoc($team)) {  ?>    
          <tr id="row<?php echo $team_members['id'] ?>" class="list_item" >
            <input type="hidden" value="<?php echo $team_members['firstname'] . ' ' . $team_members['lastname']; ?>">
            <td><?php echo $team_members['firstname'] . " " . $team_members['lastname']; ?></td>
            <td><?php echo $team_members['phone']; ?></td>
            <td><?php echo $team_members['email']; ?></td>
            <td><select><option onclick ="deleteRow(this.id);" id="<?php echo $team_members['id'] ?>" value="remove">Delete</option>
            <option onclick ="editRow(this.id);" id="<?php echo $team_members['id'] ?>" value="edit">Edit</option></select></td>
          </tr>
        <?php } ?>
    </table>
    </form>
</div>
<div id="container"></div>



<script src="../javascript/manageTeam.js"></script>
