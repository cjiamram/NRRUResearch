<?php
    include_once "config/config.php";
    $cnf=new Config();
    $rootPath=$cnf->path;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NRRU Research Institute</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="assets/images/logo/apple-touch-icon.png">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png">

    <!-- core dependcies css -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/vendor/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="assets/vendor/perfect-scrollbar/css/perfect-scrollbar.min.css" />

    <!-- page css -->

    <!-- core css -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="layout bg-gradient-info">
            <div class="container">
                <div class="row full-height align-items-center">
                    <div class="col-md-7 d-none d-md-block">
                        <img class="img-fluid" src="assets/images/logo/RDILogo.png" alt="">
                        <div class="m-t-15 m-l-20">
                          <h1 class="font-weight-light font-size-35 text-white">Research Institute of NRRU&nbsp;&nbsp;</h1>
                            <p class="text-white width-70 text-opacity m-t-25 font-size-16">Research and Development product to&nbsp; &nbsp;improve soceity of wisdom.</p>
                            <div class="m-t-60">
                                <a href="" class="text-white text-link m-r-15">Term &amp; Conditions</a>
                                <a href="" class="text-white text-link">Privacy &amp; Policy</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-shadow">
                            <div class="card-body">
                                <div class="p-h-15 p-v-40">
                                    <h2>Login&nbsp;</h2>
                                    <p class="m-b-15 font-size-13">Please enter your user name and password to login &nbsp;</p>
                                    <form>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="obj_user" placeholder="User name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="obj_password" class="form-control" placeholder="Password">
                                        </div>
                                       
                                        <a href="#" class="btn btn-block btn-lg btn-gradient-success" id="obj_login">Login</a>
                                        <div class="text-center m-t-30"> 
                                            <a href="" class="text-gray text-link text-opacity">Forget Password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- build:js assets/js/vendor.js -->
    <!-- core dependcies js -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendor/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="assets/vendor/PACE/pace.min.js"></script>
    <script src="assets/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>     
    <script src="assets/vendor/d3/d3.min.js"></script>
    <!-- endbuild -->

    <!-- build:js assets/js/app.min.js -->
    <!-- core js -->
    <script src="assets/js/app.js"></script>
    <!-- configurator js -->
    <script src="assets/js/configurator.js"></script>
    <script src="js/plugins/sweetalert/sweetalert2.all.min.js"></script>

    <!-- endbuild -->
    <script>
            
            function executeData(url,jsonObj){
            var result;
            var jsonData=JSON.stringify (jsonObj);
              $.ajax({
                //**************
                  url: url,
                  contentType: "application/json; charset=utf-8",
                  type: "POST",
                  dataType: "json",
                  data:jsonData,
                  async:false,
                  success: function(data){
                      result = data;
                  } 
                //**************
              });
              return result;
          }

            function executeGet(url){
                    var result;
                    $.ajax({
                            type:'GET',
                            url:url,
                            dataType:'json',
                            async:false,
                            success:function(data){
                            result=data;
                        }
                    });
                    return result;
            }




            function validLogin(){
              var url="<?=$rootPath?>/user/getUser.php";
              var jsonObj= {
                userName:$("#obj_user").val(),
                password:$("#obj_password").val()        
              };
              var jsonData=JSON.stringify (jsonObj);
              var data=executeData(url,jsonObj);
              if(data.flag==true){
                $(location).attr('href','index.php');
              }
              else
              {
                    url="<?=$rootPath?>/api/nrruCredential.php";
                    data=executeData(url,jsonObj);
                    if(data.message===true){
                        url="<?=$rootPath?>/menu/setMenuDefault.php?UserCode="+$("#obj_user").val();
                        flag=executeGet(url);
                        $(location).attr('href','index.php');
                    }else
                    {
                      swal.fire({
                                    title: "รหัสผ่านไม่ถูกต้อง",
                                    type: "error",
                                    buttons: [false, "ปิด"],
                                    dangerMode: true,
                                });
                    }
              }
            }

            $(document).ready(function(){
                $("#obj_login").click(function(){
                      validLogin();  
                });

            });

    </script>
  
    
</body>

</html>