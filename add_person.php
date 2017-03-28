<?php include("connection.php"); ?>
<?php include("utility.php") ?>

<?php
  $id = "";
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }

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

    if ($_POST["address"]) {
      $address = validateFormData($_POST["address"]);
    }

    if ($_POST["phone"]) {
      $phone = validateFormData($_POST["phone"]);
    }

    if ($name && $email){
      $query = "INSERT INTO people (ID, OrganisationID, Name, Email, Address, Phone)
        VALUES (NULL, '$id', '$name', '$email', '$address', '$phone')";
      if (mysqli_query($conn, $query)) {
        header("Location: people.php?id=$id&alert=success&text=New person added successfully!");
      } else {
        header("Location: people.php?id=$id&alert=danger&text=Error encountered while adding a new person!");
      }
    }
  }

  mysqli_close($conn);
  $title = "New Person";
?>

<?php include("header.php") ?>

<body>

  <?php include("navbar.php") ?>

  <div class='container'>

    <h1><?php echo $title ?></h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id"; ?>" method="post">

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
        <label for"phone">Phone</label>
        <textarea class="form-control input-lg" placeholder="Phone" name="phone"></textarea>
      </div>

      <div class='col-sm-12'>
        <hr>
        <div class='pull-right'>
          <a href="people.php?id=<?php echo $id ?>" class="btn btn-lg btn-default">Cancel</a>
          <button type="submit" class="btn btn-lg btn-success" name="add">Add</button>
        </div>
      </div>
    </form>

  </div>

  <?php include("footer.php") ?>
</body>
