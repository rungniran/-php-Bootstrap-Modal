<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	<title>CRUD</title>
</head>
<body>
    <div class="container" style="margin-top: 20px;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">เพิ่มบทความ</button>        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เขียนบทความ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="manage.php" method="post">
                        <div class="modal-body">
              	            <div class="form-group">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชื่อเรื่อง" name="title" required >
                            </div>
                            <textarea class="form-control"  name="details" id="validationTextarea" rows="5" placeholder="รายละเลียด"   required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="submit_app">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
        <br>  <br>    
        <table class="table  table-hover table-bordered" >
            <thead class="thead-dark">
                <tr>            
                    <th scope="col">หัวข้อ</th>
                    <th scope="col">เนื้อหา</th> 
                    <th scope="col">วันที่</th>
                    <th scope="col">จัดการ</th>
                </tr>
              </thead>
        <?php

        include('connect.php'); 
        $result = $con->query("SELECT * FROM content WHERE id_content order by id_content desc");
        while ($print = $result->fetch_object()) { ?>
        
                <tr>
                    <td style="width: 150px;"><?=$print->title?></td>
                    <td><?=$print->details?></td>
                    <td><?=$print->time_?></td>
                    <td style="width: 200px;">
                    	<a class="btn btn-success read" data-toggle="modal" type='button' data-title="<?=$print->title?>" data-details="<?=$print->details?>" href="">อ่าน</a>
                    	<a class="btn btn-primary edit" data-toggle="modal" type='button' data-id_content="<?=$print->id_content?>" data-title="<?=$print->title?>" data-details="<?=$print->details?>" href=""  >แก้ไข</a> 
                    	<a href="manage.php?id_content_delete=<?=$print->id_content?> " class="btn btn-danger">ลบ</a>

                    </td>
                </tr>
                
        <?php	
        }
        ?> 
        </table>
    </div>


    <!--  edit -->
    <div class="modal fade" id="formEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขบทความ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="manage.php" method="post">
                        <div class="modal-body">
              	            <div class="form-group">
                                <input type="text" class="form-control" id="title" placeholder="ชื่อเรื่อง" name="title" required >
                            </div>
                            <textarea class="form-control"  name="details" id="details" rows="5" placeholder="รายละเลียด" required></textarea>
                            <input type="hidden" id="id_content" name="id_content">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-primary" name="submit_edit" >Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 



        <!-- read -->
         <div class="modal fade" id="formRead" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">อ่าน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form action="manage.php" method="post">
                        <div class="modal-body">
              	            <div class="form-group">
                                <input type="text" class="form-control" id="title_read" placeholder="ชื่อเรื่อง"  disabled="disabled" required >
                            </div>
                            <textarea class="form-control" id="details_read" rows="10" placeholder="รายละเลียด" disabled="disabled" required></textarea>
                            <input type="hidden" id="id_content" name="id_content">
                        </div>
                    </form>
                </div>
            </div>
        </div> 
</body>
<script>   
    $(document).ready(function(){
        $('.edit').click(function(){
        	let id_content   = $(this).attr('data-id_content');
        	let title   = $(this).attr('data-title');
            let details = $(this).attr('data-details');
  
            $("#id_content").val(id_content);
            $("#title").val(title);
            $("#details").val(details);

            $('#formEdit').modal('show'); 
        }); 
        $('.read').click(function(){
        	let title   = $(this).attr('data-title');
            let details = $(this).attr('data-details');
  
            $("#title_read").val(title);
            $("#details_read").val(details);

            $('#formRead').modal('show'); 
        });
    });
</script>

</html>