<?php
include("template/Admin/menuAdmin.php");
?>
<link rel="stylesheet" type="text/css" href="css/changepass.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    
                    <div class="col-lg-6" style="min-height:700px">
                        <div class="p-5">
                            <div class="text-center">
                               
                                <img src="./images/tomo.png" width="200" height="100"/>
                                 <h1 class="h4 text-gray-900 mb-4">Change Pass !</h1>
                            </div>
                            <?php if(isset($_GET['error'])){ ?>
            <p  style="color:red "><?php echo $_GET['error'] ?></p>
            <?php } ?>
                            <form class="user" method="post" action="cpaction.php">
                                <div class="form-group pass_show">
                                    <input type="password" value="" class="form-control " placeholder="Current Password" name='currentP'>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 pass_show">
                                       <input type="password" value="<?php
                  if(isset($_GET['newpass'])){?><?php echo $_GET['newpass'] ?>
                   <?php } ?>" class="form-control" placeholder="New Password"  id="newpass"  name="newpass" >
                                    </div>
                                    <div class="col-sm-6 pass_show">
                                       <input type="password" value="<?php
                  if(isset($_GET['againpass'])){?><?php echo $_GET['againpass'] ?>
                    <?php } ?>" class="form-control" placeholder="Confirm Password" id="againpass" name="againpass">
                                    </div>
                                </div>
                                <input  class="btn btn-primary btn-user btn-block" type="submit" name="reg" value="CHANGE PASSWORD">
                            </form>
                       
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                </div>
                
            </div>
        </div>

    </div>
    <!--<script>-->
    <!--    $(document).ready(function() {-->
    <!--        $('.btn-user').on("click",function(){-->
    <!--            var userName = $("#InputID").val();-->
    <!--            var Password = $("#exampleInputPassword").val();-->
    <!--            var RePassword = $("#exampleRepeatPassword").val();-->
    <!--            $.ajax({-->
    <!--               url: 'process.php',-->
    <!--               type: 'POST',-->
    <!--               data: {userName:userName,Password:Password,RePassword:RePassword},-->
    <!--               success: function(response) {-->
    <!--               alert("thanh cong");-->
    <!--               },-->
    <!--               error: function() {-->
    <!--               alert('An error occurred');-->
    <!--               }-->
    <!--               });-->
    <!--        }) -->
    <!--    });-->
    <!--</script>-->
  <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
<script src="js/changepass.js"></script>
<?php
 require "template/Admin/footer.php";
?>
</body>

</html>