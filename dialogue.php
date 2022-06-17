<?php
include 'config.php';
include 'header.php';

if (isset($_GET['movieid'])) {
    $movieid=$_GET['movieid'];
}else{
    header('location: moviedetails.php');
}

?>


<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-12 col-lg-12 pl-0 ">
            <div class="card-body p-6 about-con pabout">

                <div class="card-title text-center mb-4" style="font-size: 24px;">
                    <b>Movie List</b>
                </div>
                <table class="table">
                    <thead>
                        <th>Dialogue Id</th>
                        <th>Movie Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Character Name</th>
                        <th>Dialogue</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $movie=mysqli_query($con,"Select d.*,m.moviename from dialogue as d left join movie as m on d.movieid=m.id where d.movieid='$movieid'");
                        if (mysqli_num_rows($movie)>0) {
                           while ($row=mysqli_fetch_assoc($movie)) {
                        ?>
                        <tr id="rowid<?php echo $row['id'];  ?>">
                            <td><?php echo $row['id'];  ?></td>
                            <td><?php echo $row['moviename'];  ?></td>
                            <td><?php echo $row['starttime'];  ?></td>
                            <td><?php echo $row['endtime'];  ?></td>
                            <td><?php echo $row['char_name'];  ?></td>
                            <td><?php echo $row['dialogue'];  ?></td>
                            <td><?php echo $row['created'];  ?></td>
                            <td><?php echo $row['updated'];  ?></td>
                            <td>
                                <a href="dialogueedit.php?dialogueid=<?php echo $row['id'];  ?>">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                <button onclick="deltedialogue(<?php echo $row['id'];  ?>)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                        

                        <?php } } ?>
                    </tbody>
                </table>


            </div>
        </div>
        
    </div>
</div>
<?php include 'footer.php'; ?>


<script type="text/javascript">
function deltedialogue(id) {
    $.ajax({
        url: 'dialogueaction.php',
        type: 'POST',
        data: {deletedialogue_id:id},
        success: function(response) { 
           console.log(response);
           if (response['status'] ==1) {
            $("#rowid"+id).hide();
             Toastify({
              text: response['result'],
              duration: 3000,
              newWindow: true,
              close: true,
              gravity: "top", 
              position: "right", 
              stopOnFocus: true, 
              style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
              },
              onClick: function(){} 
            }).showToast();

           }else{
             Toastify({
              text: response['result'],
              duration: 3000,
              newWindow: true,
              close: true,
              gravity: "top", 
              position: "right", 
              stopOnFocus: true, 
              style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
              },
              onClick: function(){} 
            }).showToast();

           }
           
     },
    error: function (request, status, error) {
        console.log(request.responseText);
    }
 });
}
</script>
