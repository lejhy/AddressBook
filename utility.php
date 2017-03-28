<?php

  function validateFormData( $formData ) {
    $formData = trim(stripcslashes(htmlspecialchars($formData)));
    return $formData;
  }

  function getAlertMessage($alert, $text) {
    $type = "";
    if($alert == 'success') {
      $type = "success";
      if ($text == "")
        $text = "Success!";
    } else if($alert == 'danger') {
      $type = "danger";
      if ($text == "")
        $text = "Danger!";
    } else if($alert == 'warning') {
      $type = "warning";
      if ($text == "")
        $text = "Warning!";
    }
    if ($type && $text)
      return "<div class='alert alert-$type'>$text<a class='close' data-dismiss='alert'>&times;</a></div>";
    else
      return "";
  }

 ?>
