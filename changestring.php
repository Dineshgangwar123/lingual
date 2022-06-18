<?php
include 'header.php';
?>


<div class="container" style="margin-top: 70px;">
    <div class="row">
        <div class="col-md-12 col-lg-12 pl-0 ">
            <div class="card-body p-6 about-con pabout">

                <div class="card-title text-center mb-4" style="font-size: 24px;">
                    <b>Create a function that transforms sentences ending with multiple question marks (?) or exclamation marks (!) into a sentence only ending with one.</b>
                </div>
                <form id="formId" action=''>
                    <div class="form-group ">
                        <label for="">Enter String</label>
                        <input type="text" name="transstring" id="transstring" class="form-control" placeholder="Enter your sentences" required>
                    </div>
                    <div class="form-group" style="margin-top:30px;margin-bottom: 30px;">
                        <input type="button" name="submit" class="btn btn-success btn-block" id="submitButton" value="Transforms String ">
                    </div>
                </form>
                <div id="resultbody" style="margin-top:50px">
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php include 'footer.php'; ?>


<script type="text/javascript">
$(() => {
$("#submitButton").click(function(e) { 
    var form = $("#formId");

    var empty = true;
    $('input[type="text"]').each(function() {
     if ($(this).val() != "") {
      empty = false;
      return false;
    }
});
    if (empty==false) {
    $.ajax({
        url: 'transformaction.php',
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
        console.log(response);
        $('#resultbody').html(''); 
        $('#resultbody').html(response); 
     },
    error: function (request, status, error) {
        console.log(request.responseText);
    }
 });
}else{
    Toastify({
              text: "Please enter string first",
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
});
});
</script>


