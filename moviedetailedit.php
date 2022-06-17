<?php
include 'config.php';
include 'header.php';
if (isset($_GET['movieid'])) {
    $movieid=$_GET['movieid'];
}else{
    header('location: cast.php');
}

$cast=mysqli_query($con,"Select * from movie where id='$movieid'");
if (mysqli_num_rows($cast)>0) {
    $row=mysqli_fetch_assoc($cast);
}else
{
    echo "Cast Id is wrong";
    die();
}
?>


<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-12 col-lg-12 pl-0 ">
            <div class="card-body p-6 about-con pabout">

                <div class="card-title text-center mb-4" style="font-size: 24px;">
                    <b>Edit Movie Details</b>
                </div>
                <form id="formId" action=''>
                   
                    <div class="form-group">
                        <label for="">Add Movie</label>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for=""></label>
                        <input type="text" name="moviename" id="moviename" class="form-control" placeholder="Enter movie name" value="<?php echo $row['moviename'] ?>">
                    </div>
                    <div class="form-group col-xs-6">
                        Movie Duration
                        <input type="time" step=".1" name="moviedurationupdate" id="moviedurationupdate" class="form-control" placeholder="Enter movie duration" value="<?php echo $row['movieduration'] ?>">
                    </div>
                    <div class="form-group" style="margin-top:30px;margin-bottom: 30px;">
                        <input type="hidden" name="movieid" id="movieid" value="<?php echo $row['id']; ?>">
                        <input type="button" name="submit" class="btn btn-success btn-block" id="submitButton" value="Update Cast">
                    </div>
                </form>

            </div>
        </div>
        
    </div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
   $("#castgender ").val("<?php echo $row['castgender']; ?>");
</script>

<script type="text/javascript">
$(() => {
$("#submitButton").click(function(e) { 
    var form = $("#formId");
    $.ajax({
        url: 'movieaction.php',
        type: 'POST',
        data: form.serialize(),
        success: function(response) { 
            console.log(response);
           if (response['status'] ==1) {
             Toastify({
              text: 'Cast successfully Updated',
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

});
});
</script>
