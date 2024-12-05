<?php
require_once 'classes/dbConnection.php';
require_once 'classes/incidentManagement.php';

$database = new Database();
$db = $database->getConnect();

$incident = new Incident($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $incident->animal_type = $_POST['animal_type'];
   $incident->date = $_POST['date'];
   $incident->description = $_POST['description'];
   $incident->status = 'pending';
   $incident->geolocation = $_POST['geolocation'];

   // Handle file upload
   if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
       $image = $_FILES['image']['name'];
       $targetDir = "incidentImages/";
       $targetFile = $targetDir . basename($image);
       $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

       // Check if the uploaded file is a valid image and within the size limit
       $check = getimagesize($_FILES["image"]["tmp_name"]);
       if ($check !== false && $_FILES["image"]["size"] <= 5000000 && in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
           // Move the uploaded file to the target directory
           if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
               // Assign the file path to the image variable
               $incident->image = $targetFile;
           } else {
               echo "Error uploading file.";
               exit;
           }
       } else {
           echo "Invalid file type or size.";
           exit;
       }
   } else {
       $incident->image = null;
   }

   if ($incident->create()) {
       echo "
       <!DOCTYPE html>
       <html lang='en'>
       <head>
           <meta charset='UTF-8'>
           <meta name='viewport' content='width=device-width, initial-scale=1.0'>
           <title>Success</title>
           <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
       </head>
       <body>
       <script>
       Swal.fire({
           title: 'Success!',
           text: 'Incident reported successfully!',
           icon: 'success'
       }).then((result) => {
           if (result.isConfirmed) {
               window.location.href = 'incidentForms.php';
           }
       });
       </script>
       </body>
       </html>";
       exit();
   } else {
       echo "Error reporting incident.";
   }
}
?>

<form action="createIncident.php" method="post" enctype="multipart/form-data" onsubmit="return getLocation()">
   <!-- existing form fields removed location input -->
   <input type="hidden" id="geolocation" name="geolocation">
   <button type="button" onclick="getLocation()">Locate</button>
   <button type="submit">Report Incident</button>
</form>

<script>
function getLocation() {
   if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(function(position) {
           const lat = position.coords.latitude;
           const lon = position.coords.longitude;
           document.getElementById('geolocation').value = lat + ',' + lon;
           window.open(`https://www.google.com/maps?q=${lat},${lon}`, '_blank');
       }, function(error) {
           console.error('Error getting geolocation: ', error);
       });
   } else {
       console.error('Geolocation is not supported by this browser.');
   }
}
</script>