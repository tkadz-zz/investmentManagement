<?php
include("autoloader.inc.php");

if(isset($_POST['btn_addDoc'])) {
    $iuID = $_GET['iuID'];


    $title = '';
    $description = '';
    

    $docFile = $_FILES['doc'];
    //File properties
    $file_name  =   $docFile['name'];
    $file_tmp   =   $docFile['tmp_name'];
    $file_size  =   $docFile['size'];
    $file_error =   $docFile['error'];



    //$allowed    = array('jpg','jpeg','png', 'pdf', 'doc', 'docx');
    $allowed    = array('pdf', 'doc', 'docx');
    //Work out file extension
    $file_ext   =   explode('.',$file_name);
    $file_ext   = strtolower(end($file_ext));

    if(in_array($file_ext,$allowed)){
        if($file_error === 0){
            if($file_size <= 20242880){
                $file_name_new  = uniqid('',true).'.'.$file_ext;
                $file_destination   ='../../documents/'.$file_name_new;

                try {
                    $dateAdded = date("Y-m-d h:m:i");
                    $s = new Usercontr();
                    $s->addDoc($title, $description, $iuID, $_SESSION['id'], $file_tmp, $file_destination, $file_name_new, $file_ext);
                } catch (TypeError $e) {
                    echo "Error" . $e->getMessage();

                }

            }
            else{
                //Art Image too big
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Art Image should be at-least 20MB in size';
                echo "<script>
                    window.location='../requestInvestment.php?iuID=$iuID';
                </script>";
            }
            // Initialise these two variables: $file_tmp, $file_destination, $file_name_new
        }
        else{
            //file not uploaded
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Document Format Not Supported';
            echo "<script>
                window.location='../requestInvestment.php?iuID=$iuID';
            </script>";
        }
    }
    else{
        //file extension error
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Document Should be either DOC, DOCX Or PDF File Format';
        echo "<script>
                window.location='../requestInvestment.php?iuID=$iuID';
            </script>";
    }


}