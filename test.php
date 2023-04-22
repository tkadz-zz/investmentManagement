





<div class="row mt-3">
    <div class="col-md-12">
        <label class="labels">Mobile Number</label>
        <input name="phone" type="text" class="form-control" placeholder="enter phone number" value="<?php echo $studentRow[0]['phone'] ?>">
    </div>
    <div class="col-md-12">
        <label class="labels">Address Line 1</label>
        <input name="homeAddress" type="text" class="form-control" placeholder="enter address line 1" value="<?php echo $studentRow[0]['homeAddress'] ?>">
    </div>
    <div class="col-md-12">
        <label class="labels">Address Line 2</label>
        <input name="postalAddress" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $studentRow[0]['postalAddress'] ?>">
    </div>
    <div class="col-md-12">
        <label class="labels">State</label>
        <input name="country" type="text" class="form-control" placeholder="enter address line 2" value="<?php echo $studentRow[0]['nationality'] ?>">
    </div>
    <div class="col-md-12">
        <label class="labels">Email ID</label>
        <input name="email" type="text" class="form-control" placeholder="enter email id" value="<?php echo $studentRow[0]['email'] ?>">
    </div>

</div>














<?php
include("dbconfig.php");
?>
<?php
session_start();
if($_SESSION['name']=='' || $_SESSION["role"]!='student')
{
    header('location:reg.php');
}

?>
<?php
function timeAgo($time_ago){

    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- http://draganzlatkovski.com/code-projects/toggle-jquery-side-bar-menu-in-bootstrap-free-template/ -->

    <title>Search</title>
    <link rel="icon" type="image/ico" href="images/logo/HMS2.png">

    <!-- jQuery -->

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="components/bootstrap/dist/js/jquery.js"></script>



    <!-- Bootstrap core CSS -->
    <link href="components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="components/bootstrap/dist/css/simple-sidebar.css" rel="stylesheet">
    <link href="components/bootstrap/dist/css/postmodal.css" rel="stylesheet">
    <link href="components/bootstrap/dist/css/fbbox.css" rel="stylesheet">







</head>


<style>
    .button {
        display: inline-flex;
        height: 40px;
        width: 150px;
        border: 2px solid #BFC0C0;
        margin: 20px 20px 20px 20px;
        text-transform: uppercase;
        text-decoration: none;
        font-size: .8em;
        letter-spacing: 1.5px;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background-color: LightSlateGrey;
        color: white;
    }

    .button a {
        color: white;
        text-decoration: none;
        letter-spacing: 1px;
        background-color: LightSlateGrey;
        font-size: 13px;
    }
    /* Fifth Button */

    #button-5 {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    #button-5 a {
        position: relative;
        transition: all .45s ease-Out;
        color: white;
        text-decoration: none;
    }

    #translate {
        transform: rotate(50deg);
        width: 100%;
        height: 250%;
        left: -200px;
        top: -30px;
        position: absolute;
        transition: all .3s ease-Out;
    }

    #button-5:hover #translate {
        left: 0;
        background: lightgreen;
    }

    #button-5:hover a {
        color: LightSlateGrey;
        background: white;
    }






    .search-sec{
        background: #1A4668;
        padding: 20px;
    }
    .search-slt{
        display: block;
        width: 100%;
        font-size: 0.875rem;
        line-height: 1.5;
        color: #55595c;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        height: calc(3rem + 2px) !important;
        border-radius:0;
    }
    .wrn-btn{
        width: 100%;
        font-size: 16px;
        font-weight: 400;
        text-transform: capitalize;
        height: calc(3rem + 2px) !important;
        border-radius:0;
    }

</style>


<body>


<?php  include("header3.php"); ?>




<!--
<div class="center"><button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary center-block">Post Task</button></div>
-->




<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">What's your Task?</h3>
            </div>
            <div class="modal-body">







            </div>



        </div>
    </div>
</div>

</form>







<div id="wrapper" class="toggled">
    <div class="container-fluid">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <br>
                </li>
                <li class="sidebar-brand">
                    <a href="#" class="navbar-brand">



                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo $userRow['name']; ?>

                    </a>
                </li>
                <li>
                    <a href="user.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> <font style="color:white"> Home </font></a>
                </li>
                <!--
                <li>
                <a href="#"><span  class="glyphicon glyphicon-comment"  aria-hidden="true"></span> Notification</a>
                </li>

                -->
                <li>
                    <a href="https://www.itean.co.zw/"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Itean Club</a>
                </li>

                <li>
                    <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Feedback</a>
                </li>

                <li>

                <li>

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->





        <!-- /#page-content-wrapper -->
    </div>
</div>
<!-- /#wrapper -->


<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- this is div for user post -->
<div class="fluid-container">
    <div class="row" style="clear:both">

        <div class="col-lg-12">


            <div class="col-lg-8">
                <span style="color: white;"><b>ADVANCED SEARCH</b></span>
                <section class="">
                    <div class="container">
                        <form action="#" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            <select class="form-control search-slt" id="exampleFormControlSelect1">
                                                <option>Search By</option>
                                                <option>Vacancy Location</option>
                                                <option>Program</option>
                                                <option>Field</option>
                                            </select>
                                        </div>


                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            <input type="text" class="form-control search-slt" placeholder="Search...">
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                            <button type="button" class="btn btn-danger wrn-btn"><span class="fa fa-search"><span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <br>
                <br>
                <?php
                $sear=$_POST["search"];
                $sql=mysqli_query($con,"select * from posts where status_title like '%$sear%'");

                while($row=mysqli_fetch_array($sql))
                {
                    $id=$row["post_id"];
                    $poid=$row["usr_id_p"];
                    $time=$row["status_time"];
                    $location=$row["status_location"];

                    $sql1=mysqli_query($con,"select * from company where usr_id='$poid'");
                    while($row1=mysqli_fetch_array($sql1)){
                        $img = $row1['image'];
                        $co_id = $row1['usr_id'];
                        $cname=$row1['name'];

                    }


                    echo '<div class="post-show" style="width:90%;border-radius:5px; box-shadow:  5px 5px 15px 2px #000000;">
									<div class="post-show-inner">
									Search Result/s for "<b><u>'.$sear.'</u></b>"
										<div class="post-header">
											<div class="post-left-box">
												<div class="id-img-box"><a href="otheruser.php?userid='.$co_id.'"><img src="user_images/'.$img.'"></a></img></div>
												<div class="id-name">
													<ul>
													<b><a href="otheruser.php?userid='.$row['usr_id'].'">	'.$row['name'].'</a> </b>
														<li><span style="color: blue;">'.$cname.' </span><br><small>'.timeAgo($time).'</small></li>
													</ul>
													<hr>
												</div>
											</div>
											<div class="post-right-box"></div>
										</div>
									
											<div class="post-body">
											<div class="post-header-text">
							 <a href="student_project_description.php?id='.$id.'&s_title=' . $row['message'] . '">
							  '.$row['status_title'].'</a>
							  
							                 <p>'.$row['message'].'</p>

											 <br/><br/>';
                    $sql1=mysqli_query($con,"select * from comments where post_id_c='$id'");
                    while($row1=mysqli_fetch_array($sql1))
                    {
                        $ct=$row1["comment_time"];
                        $c=$row1["comment"];
                        $uid=$row1["user_id_c"];
                        $sql2=mysqli_query($con,"select * from registration where usr_id='$uid'");
                        while($row2=mysqli_fetch_array($sql2))
                        {
                            $n=$row2["name"];
                            $img=$row2["image"];
                            //put echo before div to view student replies
                            '<div style="margin-left:50px">
										<a href="otheruser.php?userid='.$uid.'"><img style="height:20px; width="20px" src="user_images/'.$img.'"></img></a>
										&nbsp; &nbsp;'.$c.'
											 </div>
											 <div style="margin-left:50px"><div class="id-name">
													<ul>
													
														<small>'.timeAgo($ct).'</small> &nbsp; &nbsp; &nbsp;<font style="color:blue"> comment by :</font> <font style="font-size:12px"><a href="otheruser.php?userid='.$uid.'"> '.$n.'</a></font>
													</ul>
											</div>
										</div>
										
										';
                        }

                    }
                    //put echo before div to view student replies

                    echo '		<div class="button" id="button-5" style="box-shadow:  1px 1px 5px 2px #000000;">     <div id="translate"></div>   <a href="project_description.php?id='.$id.'&s_title=' . $row['message'] . '" -class="btn btn-default">REPLY TO VACANCY</a>   </div>
							
							
								</div>

								</div>
								</div></div><br/> ';

                }

                ?>

            </div>
            <?php echo $messa ?>
            <div>

            </div>
        </div>

        <!--content -->






    </div>

</div>

</div>




<!-- Bootstrap Core JavaScript -->
<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('.status').click(function() { $('.arrow').css("left", 0);});
        $('.photos').click(function() { $('.arrow').css("left", 146);});
    });
</script>


</body>
</html>