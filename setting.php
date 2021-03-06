<?php require 'header.php' ?>
<div class="row m-4">
    <h4>Basic Info</h4>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="../Ecomerce/assets/images/favicon.png" alt="" class="w-50 rounded-circle" style="height:183px ; object-fit : contain">
                    <h4><?php echo $websitename ?></h4>
                    <span><?php echo $websitelocation ?></span> <br>
                    <span><?php echo $websiteemail ?></span> <br>
                    <span><?php echo $websitenum ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card"   >
                <div class="card-body">
                    <form action="controller/update.php" method="post">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="websitename">Website Name</label>
                                <input type="text" name="websitename" class="form-control" value="<?php echo $websitename ?>">
                            </div>
                            <div class="col-6">
                                <label for="websiteemail">Email</label>
                                <input type="text" name="websiteemail"  value="<?php echo $websiteemail ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="websitenum">Number</label>
                                <input type="text" name="websitenum" value="<?php echo $websitenum ?>" class="form-control">
                            </div>
                            <div class="col-6">
                                <label for="location">Location</label>
                                <input type="text" name="location"  value="<?php echo $websitelocation ?>" class="form-control">
                            </div>
                        </div>
     
                        <div class="form-group text-center">
                        <input type="submit" name="websitedataupdatesioefw" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
        <table class="table table-striped table-centered mb-0">
            <thead>
                <tr>
                    <th>Icons</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="socialmediadata">
                <?php foreach($socialmediadata as $key => $socialmediavalue) { ?>
                <tr id="socialrow_<?php echo $socialmediavalue['id'] ?>">
                    <td class="table-user">
                       <i class ="ion-social-<?php echo $socialmediavalue['icon'] ?>"></i>
                    </td>
                    <td> <?php echo $socialmediavalue['name'] ?></td>
                    <td> <?php echo $socialmediavalue['url'] ?></td>
                    <td class="table-action">
                        <a onclick="deletesocial(<?php echo $socialmediavalue['id'] ?>)" class="action-icon"> <i class="ion ion-trash-b "></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="mt-3" id="addnewsocialmedia" >
            <div class="mb-3">
            <label class="form-label">Add </label>
                <div class="input-group">
                    <select class="form-control" id="socialmediaicon">
                        <option selected disabled >Select Platform</option>
                        <option value="facebook ">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="instagram">Instagram</option>
                        <option value="linkedin">Linkedin </option>
                        <option value="youtube">Youtube </option>
                        <option value="ion-earth">Other </option>
                    </select>
                    <input class="form-control" id="socialmediaurl" placeholder="Url : eg - http://www.website.com/profile"  type="url">
                    <input class="btn btn-dark"  type="submit" value="Submit">
                </div>
            </div>
        </form>                                      
        </div>
    </div>
</div>
<?php require 'footer.php' ?>

<script>



$("#addnewsocialmedia").submit(function(e){
e.preventDefault();

var socialmediaurl = $('#socialmediaurl').val();
var socialname = $('#socialmediaicon option:selected').text();
var socialicon = $('#socialmediaicon').val();

if(socialicon != null && socialmediaurl!=''){
    $('#socialmediaicon').removeClass('is-invalid');
    $('#socialmediaurl').removeClass('is-invalid');
    // alert(socialicon);
    $.ajax({
        url: "controller/add.php",
        method: 'POST',
        data:{'socialmediaurl':socialmediaurl,
                'socialname':socialname,
                'socialicon':socialicon
        },
        success:function(data){
            var result = $.trim(data);
            if(result == 'fail'){
            }else{
                $('#socialmediadata').html(data); 
           }
           }
        }); 
    

    // $("#addnewsocialmedia").reset();
    document.getElementById("addnewsocialmedia").reset();

}
else if(socialicon == null && socialmediaurl==''  ){
    $('#socialmediaurl').addClass('is-invalid');
    $('#socialmediaicon').addClass('is-invalid');

}else if (socialmediaurl==''){
    $('#socialmediaurl').addClass('is-invalid');
}
else{
    // $('#socialmediaurl').addClass('is-invalid');
    $('#socialmediaicon').addClass('is-invalid');
}


});
</script>