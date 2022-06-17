<?php
include 'config.php';
include 'header.php';
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
                        <th>Movie Id</th>
                        <th>Movie Name</th>
                        <th>Movie Duration</th>
                        <th>Cast</th>
                        <th>Dialogue</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $movie=mysqli_query($con,"Select * from movie");
                        if (mysqli_num_rows($movie)>0) {
                           while ($row=mysqli_fetch_assoc($movie)) {
                        ?>
                        <tr id="rowid<?php echo $row['id'];  ?>">
                            <td><?php echo $row['id'];  ?></td>
                            <td><?php echo $row['moviename'];  ?></td>
                            <td><?php echo $row['movieduration'];  ?></td>
                            <td>
                                <a href="cast.php?movieid=<?php echo $row['id'];  ?>"><button class="btn btn-primary">View</button></a> 
                            </td>
                            <td>
                                <a href="dialogue.php?movieid=<?php echo $row['id'];  ?>"><button class="btn btn-primary">View</button></a>
                            </td>
                            <td><?php echo $row['created'];  ?></td>
                            <td><?php echo $row['updated'];  ?></td>
                            <td>
                                <a href="moviedetailedit.php?movieid=<?php echo $row['id'];  ?>">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                                <button onclick="deltemovie(<?php echo $row['id'];  ?>)" class="btn btn-danger">Delete</button>
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

<script type="text/javascript">
function deltemovie(id) {
    $.ajax({
        url: 'movieaction.php',
        type: 'POST',
        data: {deletemovie_id:id},
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



