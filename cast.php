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
                        <th>Cast Id</th>
                        <th>Movie Name</th>
                        <th>Cast Name</th>
                        <th>Cast Gender</th>
                        <th>Cast Character Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $movie=mysqli_query($con,"Select c.*,m.moviename from cast as c left join movie as m on c.movieid=m.id where c.movieid='$movieid'");
                        if (mysqli_num_rows($movie)>0) {
                           while ($row=mysqli_fetch_assoc($movie)) {
                        ?>
                        <tr id="rowid<?php echo $row['id'];  ?>">
                            <td><?php echo $row['id'];  ?></td>
                            <td><?php echo $row['moviename'];  ?></td>
                            <td><?php echo $row['castname'];  ?></td>
                            <td><?php echo $row['castgender'];  ?></td>
                            <td><?php echo $row['cast_char_name'];  ?></td>
                            <td><?php echo $row['created'];  ?></td>
                            <td><?php echo $row['updated'];  ?></td>
                            <td>
                                <a href="castedit.php?castid=<?php echo $row['id'];  ?>">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                <button onclick="deltecast(<?php echo $row['id'];  ?>)" class="btn btn-danger">Delete</button>
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
function deltecast(id) {
    $.ajax({
        url: 'castaction.php',
        type: 'POST',
        data: {deletecast_id:id},
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
