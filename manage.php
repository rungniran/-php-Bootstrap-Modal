<?php 


add();
delete();
edit();

function add(){
    include('connect.php');
	if (isset($_POST['submit_app'])) {
	    $title   = $_POST['title'];
	    $details = $_POST['details'];
	    $time_   = date("d/m/y");
	    $sql     = "INSERT INTO content (title, details, time_) VALUES ('$title','$details','$time_')";
	    $result  = $con->query($sql);
	    if ($result) {
	    	header("Location:index.php"); 
	    }
	}
}


function delete(){
	include('connect.php');
	if (isset($_GET['id_content_delete'])) {
		$sql = ("DELETE FROM content WHERE id_content=".$_GET['id_content_delete']);
        $result  = $con->query($sql);
        if($result){
            header("Location:index.php"); 
        }   
        else{
            echo('error');
            exit();  
        }
	}
}

function edit(){
	include('connect.php');;
	if (isset($_POST['submit_edit'])) {
		$title   = $_POST['title'];
		$details = $_POST['details'];
		$sql     = "UPDATE content SET title = '$title', details = '$details' WHERE id_content =".$_POST['id_content'];
		$result  = $con->query($sql);
        if ($result) {  
            header("Location: index.php");
        }
	}
}

?>