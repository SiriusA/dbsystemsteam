<?php

  if($_SESSION["usertype"] == 1){
      include_once "../nav_bar/nav_bar_super.php";
  }
  if($_SESSION["usertype"] == 2){
      include_once "../nav_bar/nav_bar_admin.php";
  }
  else if ($_SESSION["usertype"] == 3){
      include_once "../nav_bar/nav_bar_student.php";
  }

/*
  if($_SESSION["usertype"] == 1){
      include_once "../nav_bar/super_admin_navbar.php";
  }
  if($_SESSION["usertype"] == 2){
      include_once "../nav_bar/admin_navbar.php";
  }
  else if ($_SESSION["usertype"] == 3){
      include_once "../nav_bar/student_navbar.php";
  }
*/
?>
