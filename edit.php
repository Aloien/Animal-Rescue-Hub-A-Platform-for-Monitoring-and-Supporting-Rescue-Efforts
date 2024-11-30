<?php
require_once 'classes/crudOperation.php';
$crud = new CrudOperation();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $crud->getUserById($id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $password = htmlspecialchars(trim($_POST['password']));

    $success = $crud->updateUser($id, $name, $email, $phone, $password);
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>SweetAlert</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
    <script>
    Swal.fire({
        title: '". ($success ? 'Success!' : 'Error!') ."',
        text: '". ($success ? 'Data was updated successfully!' : 'Error when updating data!') ."',
        icon: '". ($success ? 'success' : 'error') ."'
    }).then((result) => {
        if(result.isConfirmed) {
            window.location.href = 'admin_dashboard.php';
        }
    });
    </script>
    </body>
    </html>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
<?php if (isset($user)): ?>
<h2>Edit User</h2>
<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br><br>

    <label for="phone">Phone Number:</label><br>
    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required><br><br>
    
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required><br><br>
    
    <input type="submit" name="submit" value="Update">
</form>
<?php else: ?>
    <p>User not found.</p>
<?php endif; ?>
</body>
</html>
