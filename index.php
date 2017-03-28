<?php include("connection.php") ?>
<?php include("utility.php") ?>

<?php
  $alertMessage = "";
  if (isset($_GET["alert"])) {
    if (isset($_GET["text"]))
      $alertMessage = getAlertMessage($_GET["alert"], $_GET["text"]);
    else
      $alertMessage = getAlertMessage($_GET["alert"], "");
  }

  $title = "Address Book";
?>

<?php include("header.php") ?>

<body>

  <?php include("navbar.php") ?>

  <div class='container'>

    <h1><?php echo $title ?></h1>

    <?php
      echo $alertMessage;

      $query = "SELECT * FROM organisations";
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
              Description
            </th>
            <th>

            </th>
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
              $row["Description"] .
            "</td>
            <td>
              <a href='edit_organisation.php?id=" . $row["ID"] . "' type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span> Edit</a>
              <a href='people.php?id=" . $row["ID"] . "' type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-folder-open'></span> Open</a>
            </td>
          </tr>";
        }
        echo "</table>";

      } else {
        echo getAlertMessage("warning", "You have no organisations!");
      }
    ?>

    <a class='btn btn-success btn-lg pull-right' href="add_organisation.php" role="button">Add</a>
  </div>

  <?php include("footer.php") ?>
</body>
