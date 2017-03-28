<?php include("connection.php"); ?>
<?php include("utility.php") ?>

<?php
  if (isset($_POST["add"])) {

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
      $query = "INSERT INTO organisations (ID, Name, Email, Address, Description)
        VALUES (NULL, '$name', '$email', '$address', '$description')";

      if (mysqli_query($conn, $query)) {
        header("Location: index.php?alert=success&text=New organisation added!");
      } else {
        header("Location: index.php?alert=danger&text=Organisation was updated!");
      }
    }
  }

  mysqli_close($conn);
  $title = "New Organisation";
?>

<?php include("header.php") ?>

<body>

  <?php include("navbar.php") ?>

  <div class='container'>

    <h1><?php echo $title ?></h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

      <div class='form-group col-sm-6'>
        <label for"name">Name<small class="text-danger"> *<?php echo @$nameError; ?></small></label>
        <input type="text" class="form-control input-lg" placeholder="Name" name="name">
      </div>

      <div class='form-group col-sm-6'>
        <label for"email">Email<small class="text-danger"> *<?php echo @$emailError; ?></small></label>
        <input type="text" class="form-control input-lg" placeholder="Email" name="email">
      </div>

      <div class='form-group col-sm-6'>
        <label for"address">Address</label>
        <input type="text" class="form-control input-lg" placeholder="Address" name="address">
      </div>

      <div class='form-group col-sm-6'>
        <label for"description">Description</label>
        <textarea class="form-control input-lg" placeholder="Description" name="description"></textarea>
      </div>

      <div class='col-sm-12'>
        <hr>
        <div class='pull-right'>
          <a href="index.php" class="btn btn-lg btn-default">Cancel</a>
          <button type="submit" class="btn btn-lg btn-success" name="add">Add</button>
        </div>
      </div>
    </form>

  </div>

  <?php include("footer.php") ?>
</body>
