<?php include("connection.php"); ?>
<?php include("utility.php") ?>

<?php
  $alertMessage = "";
  if (isset($_GET["alert"])) {
    if (isset($_GET["text"]))
      $alertMessage = getAlertMessage($_GET["alert"], $_GET["text"]);
    else
      $alertMessage = getAlertMessage($_GET["alert"], "");
  }

  $id = "";
  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  }

  $query = "SELECT Name FROM organisations WHERE ID='$id'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $title = $row["Name"];
  } else {
    $title = "People";
  }
?>

<?php include("header.php") ?>

<body>

  <?php include("navbar.php") ?>

  <div class='container'>

    <h1><?php echo $title ?></h1>

    <?php
      echo $alertMessage;

      $query = "SELECT * FROM people WHERE OrganisationID='$id'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered'>
          <tr>
            <th>
              ID
            </th>
            <th>
              Name
            </th>
            <th>
              Email
            </th>
            <th>
              Address
            </th>
            <th>
              Phone
            </td>
            <td>

            </td>
          </tr>";

        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>" .
              $row["ID"] .
            "</td>
            <td>" .
              $row["Name"] .
            "</td>
            <td>" .
              $row["Email"] .
            "</td>
            <td>" .
              $row["Address"] .
            "</td>
            <td>" .
              $row["Phone"] .
            "</td>
            <td>
              <a href='edit_person.php?id=" . $row["ID"] . "' type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span> Edit</a>
            </td>
          </tr>";
        }
        echo "</table>";
      } else {
        echo getAlertMessage("warning", "You have no people!");
      }
    ?>

    <a class='btn btn-default btn-lg' href="index.php" role="button">Back</a>
    <a class='btn btn-success btn-lg pull-right' href="add_person.php?id=<?php echo $id ?>" role="button">Add</a>
  </div>

  <?php include("footer.php") ?>
</body>
