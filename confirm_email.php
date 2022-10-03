<?php
include('includes/db.php');
include 'includes/css_links.php';
$id = $_GET['id'];
$decodId = base64_decode($id);
$fetchData = "UPDATE candidates SET status = '1' WHERE id = '$decodId'";
$runData = mysqli_query($connection, $fetchData);


if ($runData) {
  echo "<!DOCTYPE html>
      <html>
        <body> 
        <script>
        Swal.fire(
          'Verification !',
          'Email Successfully Verify , Login Now !',
          'success'
        ).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'online_registration.php';
          }
        });
        </script>
        </body>
      </html>";
}

?>

<?php include 'includes/js_links.php'; ?>