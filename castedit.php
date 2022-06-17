<?php
include 'config.php';
include 'header.php';
if (isset($_GET['castid'])) {
    $castid=$_GET['castid'];
}else{
    header('location: cast.php');
}

$cast=mysqli_query($con,"Select * from cast where id='$castid'");
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
                    <b>Edit Cast Details PANEL</b>
                </div>
                <form id="formId" action=''>
                   
                    <div class="form-group">
                        <label for="">Cast Details</label>
                    </div>
                    <div class="cast-outer">
                        <div class="cast-inner">
                            <div class="form-group col-xs-4">
                                <input type="text" name="castname" id="castname" class="form-control" placeholder="Enter cast name" value="<?php echo $row['castname']; ?>">
                            </div>
                            <div class="form-group col-xs-4">
                                <select name="castgender" id="castgender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="M" >Male</option>
                                    <option value="F" >Female</option>
                                    <option value="O" >Other</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-4">
                                <input type="text" name="castcharacter" id="castcharacter" class="form-control" placeholder="Enter cast character name" value="<?php echo $row['cast_char_name']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:30px;margin-bottom: 30px;">
                        <input type="hidden" name="castid" id="castid" value="<?php echo $row['id']; ?>">
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
        url: 'castaction.php',
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
