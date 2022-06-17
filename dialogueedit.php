<?php
include 'config.php';
include 'header.php';
if (isset($_GET['dialogueid'])) {
    $dialogueid=$_GET['dialogueid'];
}else{
    header('location: cast.php');
}

$cast=mysqli_query($con,"Select * from dialogue where id='$dialogueid'");
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
                    <b>Movie PANEL</b>
                </div>
                <form id="formId" action=''>                
                    <div class="form-group">
                        <label for="">Dialogue List</label>
                    </div>
                    <div class="form-group col-xs-3">
                        Dialogue start time
                        <input type="time" step=".1" name="dstarttime" id="dstarttime" class="form-control" value="<?php echo $row['starttime']; ?>">
                    </div>
                    <div class="form-group col-xs-3">
                        Dialogue end time
                        <input type="time" step=".1" name="dendtime" id="dendtime" 
                        class="form-control" value="<?php echo $row['endtime']; ?>">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for=""></label>
                        <input type="text" name="dcharactername" id="dcharactername" class="form-control" placeholder="Enter character name" value="<?php echo $row['char_name']; ?>">
                    </div>
                    <div class="form-group col-xs-3">
                        <label for=""></label>
                        <input type="text" name="dialogue" id="dialogue" class="form-control" placeholder="Enter dialogue" value="<?php echo $row['dialogue']; ?>">
                    </div>

                    <div class="form-group" style="margin-top:30px;margin-bottom: 30px;">
                        <input type="hidden" name="dialogueid" id="dialogueid" value="<?php echo $row['id']; ?>">
                        <input type="button" name="submit" class="btn btn-success btn-block" id="submitButton" value="Update Dialogue">
                    </div>
                </form>

            </div>
        </div>
        
    </div>
</div>
<?php include 'footer.php'; ?>


<script type="text/javascript">
$(() => {
$("#submitButton").click(function(e) { 
    var form = $("#formId");
    $.ajax({
        url: 'dialogueaction.php',
        type: 'POST',
        data: form.serialize(),
        success: function(response) { 
            console.log(response);
           if (response['status'] ==1) {
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

});
});
</script>
