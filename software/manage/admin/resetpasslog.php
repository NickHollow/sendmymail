<?php
include 'session.php';
?>  
<!DOCTYPE html>
<html>
  <head>
        <!-- page script -->
   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['projectname']; ?> | Data Tables</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
<?php include 'web/header2.php'; ?>
      <!-- Left side column. contains the logo and sidebar -->
     <?php include 'web/sidebar.php'; ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            User Reset Password Log
            <small></small>
          </h1>
     
        </section>
<script type="text/javascript">

  function removeFunction(str) {
   if (confirm('Are you sure you want to delete this record?') == true) {
  if (str.length == 0) { 
          document.getElementById("txtHint").innerHTML = "";
          return;
      } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
              }
          };
   xmlhttp.open("POST", "add-item.php?ac=1&q=" + str, true);
xmlhttp.send();
        }
window.location.reload();
  }
  else {
        
      }
  }
</script>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Records are auto-deleted every 24 months</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

<?php
include 'web/connect.php';

$con=mysqli_connect($servername1, $username1, $password1, $dbname1);
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$mysqlstat = "SELECT * FROM resetpasslog ORDER BY time DESC";
$result = mysqli_query($con, $mysqlstat);
$rows = mysqli_num_rows($result);



echo "<div class='table-responsive'><table class='table table-bordered table-striped' id='example2' class='table table-bordered table-striped'><thead><tr>";
if($rows > 0)
{
echo "<th>ID</th>
<th>Username</th>
<th>OTP</th>
<th>Old Password</th>
<th>New Password</th>
<th>Time</th>
<th>IP</th>
</tr></thead><tbody>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['ID'] . "</td>";
echo "<td>" . $row['user'] . "</td>";
echo "<td>" . $row['otp']. "</td>";
echo "<td>" . $row['oldpass'] . "</td>";
echo "<td>" . $row['newpass'] . "</td>";
echo "<td>" . $row['time'] . "</td>";
echo "<td>" . $row['IP'] . "</td>";

echo "</tr>";
}
echo "</tbody>";
} //Ending IF Condition
else
{
echo "<th><center>No records to display</center></th></tr></thead><tbody></tbody>";
}
echo "</table></div>";


mysqli_close($con);
?>
 
   


                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <?php include 'web/footer2.php'; ?>

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
                
 <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
   
  </body>
</html>
