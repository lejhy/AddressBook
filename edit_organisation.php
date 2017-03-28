<?php include("connection.php"); ?>
<?php include("utility.php") ?>

<?php

  $id = "";
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM organisations WHERE ID='$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["Name"];
        $email = $row["Email"];
        $address = $row["Address"];
        $description = $row["Description"];
      }
    } else {
      header("Location: index.php?alert=danger&text=Encountered error while editing organisation!");
    }
  }

  if (isset($_POST["update"])) {

    if (!$_POST["name"]) {
      $nameError = "Please enter a name";
      $name = "";
    } else {
      $name = validateFormData($_POST["name"]);
    }

    if (!$_POST["email"]) {
      $emailError = "Please enter an email";
      $email = "";
    } else {
      $email = validateFormData($_POST["email"]);
    }

    $address = "";
    if ($_POST["address"]) {
      $address = validateFormData($_POST["address"]);
    }

    $description = "";
    if ($_POST["description"]) {
      $description = validateFormData($_POST["description"]);
    }

    if ($name && $email){
      $query = "UPDATE organisations SET
        Name = '$name',
        Email = '$email',
        Address = '$address',
        Description = '$description'
        WHERE ID = '$id'";
      $result = mysqli_query($conn, $query);
      if ($result) {
        header("Location: index.php?alert=success&text=Organisation was successfully updated!");
      } else {
        header("Location: index.php?alert=danger&text=Error while updating organisation!");
      }
    }
  }

  $alertMessage = "";
  if (isset($_POST["delete"])) {
    $alertMessage = "<div class='alert alert-danger'>
        <p>Are you sure you want to delete this organisation? All of it's members will be deleted as well. There is no going back!</p><br>
        <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id' method='post'>
          <input type='submit' class='btn btn-danger btn-sm' name='confirm-delete' value='Yes, delete everything'>
          <a type='button' class='btn btn-default btn-sm' data-dismiss='alert'>No, I changed my mind...</a>
        </form>
      </div>";
  }

  if (isset($_POST["confirm-delete"])) {
    $query = "DELETE FROM people WHERE organisationID='$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $query = "DELETE FROM organisations WHERE id='$id'";
      $result = mysqli_query($conn, $query);
      if ($result) {
        header("Location: index.php?alert=success&text=Organisation was deleted!");
      } else {
        header("Location: index.php?alert=danger&text=Error while deleting an organisation!");
      }
    } else {
      header("Location: index.php?alert=danger&text=Error while deleting people from the organisation!");
    }
  }

  mysqli_close($conn);
  $title = "Edit Organisation";
?>

<?php include("header.php") ?>

<body>

  <?php include("navbar.php") ?>

  <div class='container'>

    <h1><?php echo $title ?></h1>

    <?php echo $alertMessage ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id"; ?>" method="post">

    <div class='form-group col-sm-6'>
      <label for"name">Name<small class="text-danger"> *<?php echo @$nameError; ?></small></label>
      <input type="text" class="form-control input-lg" placeholder="Name" value="<?php echo $name; ?>" name="name">
    </div>

    <div class='form-group col-sm-6'>
      <label for"email">Email<small class="text-danger"> *<?php echo @$emailError; ?></small></label>
      <input type="text" class="form-control input-lg" placeholder="Email" value="<?php echo $email; ?>" name="email">
    </div>

    <div class='form-group col-sm-6'>
      <label for"address">Address</label>
      <input type="text" class="form-control input-lg" placeholder="Address" value="<?php echo $address; ?>" name="address">
    </div>

    <div class='form-group col-sm-6'>
      <label for"description">Description</label>
      <textarea class="form-control input-lg" placeholder="Description" name="description"><?php echo $description; ?></textarea>
    </div>

    <div class='col-sm-12'>
      <hr>
      <button type="submit" class="btn btn-lg btn-danger" name="delete">Delete</button>
      <div class='pull-right'>
        <a href="index.php" class="btn btn-lg btn-default">Cancel</a>
        <button type="submit" class="btn btn-lg btn-success" name="update">Update</button>
      </div>
    </div>

    </form>
  </div>

  <?php include("footer.php") ?>
</body>
