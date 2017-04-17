<?php
     session_start();

     if($_SESSION["userLoggedIn"] == false)
         header('Location: /');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create University</title>

    <!--    <link rel="stylesheet" href="/stylesheets/list_university.css">-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php


    if($_SESSION["usertype"] == 2)
        include "../nav_bar/admin_navbar.php";
    else if ($_SESSION["usertype"] == 3){
        include "../nav_bar/student_navbar.php";
    }

    include "../db/query_events.php";

    //get list of events that this student is going to attend
    $eventAttendingList = getEventsAttending();


?>

    <div id="content" class="container-fluid">
        <h2>Events Attending</h2>

            <!--        1/1 row-->
            <div class="row">

                <!--                    1/2 column-->
                <!--            place buttons here-->
                <div class="col-sm-6">

                    <div class="list-group">
                        <div class="row">
                            <div class="col-sm-5">
                                <a href="#" class="list-group-item">Event Description</a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#" class="list-group-item">Date</a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#" class="list-group-item">University</a>
                            </div>
                            <div class="col-sm-2">
                                <a href="#" class="list-group-item">Status</a>
                            </div>
                        </div>

                    </div>

                    <?php
                    if(empty($_GET["page"])){
                        $page = 0;
                        $remaining = sizeof($eventAttendingList);
                    }
                    else{
                        $page = $_GET["page"];
                        $remaining = $_GET["remaining"];
                    }

    //                echo $eventAttendingList[0]["ename"] . "<br>";
    //                echo $eventAttendingList[0]["description"] . "<br>";
    //                echo $eventAttendingList[0]["start_time"] . "<br>";
    //                echo $eventAttendingList[0]["end_time"] . "<br>";
    //                echo $eventAttendingList[0]["approved"] . "<br>";

                    $nextPage = -1;
                    //        only display 7
                    echo '<ul class="list-group">';
                    if($remaining > 7){
                        $index = sizeof($eventAttendingList) - $remaining;
                        for($i = 0; $i < 7; $i++){
                            echo '<div class="row">
                                    <div class="col-sm-5">
                                        <a href="../rso_description/index.php?index='.($i + $index).'" class="list-group-item">'.$eventAttendingList[$i + $index]["ename"].' - '.$eventAttendingList[$i]["description"].'</a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="#" class="list-group-item">'.$eventAttendingList[$i + $index]["start_time"].'</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" class="list-group-item">University</a>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="list-group-item">'.$eventAttendingList[$i + $index]["approved"].'</a>
                                    </div>
                                  </div>';
                        }
                        $nextPage = $page + 1;
                    }
                    //        display what is left
                    else{
                        $index = sizeof($eventAttendingList) - $remaining;
                        for($i = $index; $i < sizeof($eventAttendingList); $i++){
                            echo '<div class="row">
                                    <div class="col-sm-5">
                                        <a href="../rso_description/index.php?index='.($i).'" class="list-group-item">'.$eventAttendingList[$i]["ename"].' - '.$eventAttendingList[$i]["description"].'</a>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="#" class="list-group-item">'.$eventAttendingList[$i]["start_time"].'</a>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" class="list-group-item">University</a>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="list-group-item">'.$eventAttendingList[$i]["approved"].'</a>
                                    </div>
                                  </div>';
                        }
                    }
                    echo '</ul>';

                    //start pager
                    echo '<div class="row">';
                        echo    '<ul class="pager">';

                            //display previous button?
                            if($page != 0){
                            $prevPage = $page - 1;
                            $prevRemaining = $remaining + 7;
                            //DISPLAY PREV BUTTON
                            echo    '<li><a href="index.php?page='.$prevPage.'&remaining='.$prevRemaining.'">Previous</a></li>';

                            }
                            echo    '<li>Page '.$page.'</li>';

                            //display next button?
                            if($nextPage != -1){
                            $nextRemaining = $remaining - 7;
                            //display next button here
                            echo '<li><a href="index.php?page='.$nextPage.'&remaining='.$nextRemaining.'">Next</a></li>';

                            }
                            echo    '</ul>';
                        echo '</div>';
                    //end pager
                    ?>
                </div>


                <!--                2/2 column-->
                <!--            Calendar here-->
                <div class="col-sm-6">
                        <iframe src="https://calendar.google.com/calendar/embed?src=8c1o31v12mspk56gncmoqb6a70%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="700" height="550" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>



    </div>


</body>
