<?php
include 'header.php';
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
                        <label for="">Add Movie</label>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for=""></label>
                        <input type="text" name="moviename" id="moviename" class="form-control" placeholder="Enter movie name" required>
                    </div>
                    <div class="form-group col-xs-6">
                        Movie Duration
                        <input type="time" step=".1" name="movieduration" id="movieduration" class="form-control" placeholder="Enter movie duration">
                    </div>
                    <div class="form-group">
                        <label for="">Cast Details</label>
                    </div>
                    <div class="cast-outer">
                        <div class="cast-inner">
                            <div class="form-group col-xs-4">
                                <input type="text" name="castname[]" id="castname" class="form-control" placeholder="Enter cast name">
                            </div>
                            <div class="form-group col-xs-4">
                                <select name="castgender[]" id="castgender" class="form-control">
                                    <option >Select Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="O">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-4">
                                <input type="text" name="castcharacter[]" id="castcharacter" class="form-control" placeholder="Enter cast character name">
                            </div>
                        </div>
                    </div>
                    <div align="right">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add More" id="add-cast" style="margin-right:11px">
                    </div>                
                    <div class="form-group">
                        <label for="">Dialogue List</label>
                    </div>
                    <div class="dialogue-outer">
                        <div class="dialogue-inner">
                            <div class="form-group col-xs-3">
                                Dialogue start time
                                <input type="time" step=".1" name="dstarttime[]" id="dstarttime" class="form-control" placeholder="Enter Dialogue start time">
                            </div>
                            <div class="form-group col-xs-3">
                                Dialogue end time
                                <input type="time" step=".1" name="dendtime[]" id="dendtime" 
                                class="form-control" placeholder="Enter Dialogue end time">
                            </div>
                            <div class="form-group col-xs-3">
                                <label for=""></label>
                                <input type="text" name="dcharactername[]" id="dcharactername" class="form-control" placeholder="Enter character name">
                            </div>
                            <div class="form-group col-xs-3">
                                <label for=""></label>
                                <input type="text" name="dialogue[]" id="dialogue" class="form-control" placeholder="Enter dialogue">
                            </div>
                        </div>
                    </div>
                    <div align="right">
                        <input type="submit" name="submit" class="btn btn-primary" value="Add More" id="add-dialogue" style="margin-right:11px">
                    </div>
                    <div class="form-group" style="margin-top:30px;margin-bottom: 30px;">
                        <input type="button" name="submit" class="btn btn-success btn-block" id="submitButton" value="Save Movie">
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

    var empty = true;
    $('input[type="text"]').each(function() {
     if ($(this).val() != "") {
      empty = false;
      return false;
    }
});
    if (empty==false) {
    $.ajax({
        url: 'movieaction.php',
        type: 'POST',
        data: form.serialize(),
        success: function(response) { 
           console.log(response);
           
           if (response['status'] ==1) {
            $("#formId").trigger("reset");
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
}else{
    Toastify({
              text: "Please Fill the complete form",
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

<script type="text/javascript">
 var data_fo = $('.cast-outer').html();
 var sd = '<div align="left" class="remove-add-cast"><button style="margin-bottom:8px" class="btn btn-danger">Remove</button></div>';
 var data_combine = data_fo.concat(sd);
 var wrapper = $(".cast-inner"); 
 var add_button = $("#add-cast"); 

 $(add_button).click(function(e){
  e.preventDefault();
  $(wrapper).append(data_combine);
});

 $(wrapper).on("click",".remove-add-cast", function(e){ 
    e.preventDefault();
    $(this).prev('.cast-inner').remove();
    $(this).remove();
})

 var data_fo_dialoge = $('.dialogue-outer').html();
 var dialremove = '<div align="left" class="remove-add-dialogue"><button style="margin-bottom:8px" class="btn btn-danger">Remove</button></div>';
 var data_combine_dialogue = data_fo_dialoge.concat(dialremove);
 var dialogwrapper = $(".dialogue-inner"); 
 var add_button_dialog = $("#add-dialogue"); 

 $(add_button_dialog).click(function(e){
  e.preventDefault();
  $(dialogwrapper).append(data_combine_dialogue);
});

 $(dialogwrapper).on("click",".remove-add-dialogue", function(e){ 
    e.preventDefault();
    $(this).prev('.dialogue-inner').remove();
    $(this).remove();
}) 
</script>


