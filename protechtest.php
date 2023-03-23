
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row" style="min-height:700px;">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                               
                                <img src="./images/tomo.png" width="200" height="100"/>
                                 <h1 class="h4 text-gray-900 mb-4">Create New Account !</h1>
                            </div>
                            <?php if(isset($_GET['error'])){ ?>
                            <p  style="color:red "><?php echo $_GET['error'] ?></p>
                            <?php } ?>
                            <form class="user" method="post" action="actionaddnewuser.php">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="InputID"
                                        placeholder="User Name" name="userName">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" name="rePassword">
                                    </div>
                                    <div class="col-sm-4">
                                        <select class=" form-control-user form-select-sm form-select-lg " style="width: 160px;height: 70px;">
                                            <option class="form-control form-control-user" value="1">Lead</option>
                                            <option class="form-control form-control-user" value="2">User</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <input  class="btn btn-primary btn-user btn-block" type="submit" name="reg" value="Register Account">
                            </form>
                        </div>
                    </div>
                    
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
  