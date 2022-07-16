<?php
require_once 'requirements/header.php';

session_start();
?>
  <!-- logout form view screen 1 -->
  <!-- <div class="outOfSystem">
         <div class="wrap">
            <div class="logoutMessage">
                <p>You are logged out!</p>
            </div>
            <div class="contentLogout">
                    <div class="logouthead"><p>Login</p> </div>
                    <div class="logForm">
                        <form action="login.inc.php" method="POST">
                            <input type="text" name="maiduid" placeholder=" enter username or e-mail..">
                            <input type="password" name="pwd" placeholder="password..">
                            <button type="submit" class="btn" name="login-btn">Login</button>
                        </form>

                    </div>
                    <div class="signupLink"><a href="signup.php">create an account?</a></div>
                </div>

            </div>
        </div>
         -->
<!-- loggged in form view 2 -->
<section class="gallery-link">

    <div class="wrapper">

    <h3 style="color:gold; padding:0.5rem; text-shadow: 1px 1px white;"> HISTOIRE</h3>

    <div class="gallery-container">
     <?php
     include_once 'includes/dbh.inc.php';
     $sql = "SELECT * FROM gallery ORDER BY orderGallery DESC";
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt,$sql)) {
         header("Location: index.php?error=sqlerror");
     }else{
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         while ($row = mysqli_fetch_assoc($result)) {
            echo'<a href="#">
            <div class="allImg" style="background-image:url(uploads/'.$row["imgFullNameGallery"].');"></div>
            <hr class="line">
            <h3>'.$row["titleGallery"].'</h3>
            <p class="imgpara"> '.$row["descGallery"].' <br> <em>'.$row["date"].'</em></p>
          </a>';
         }

     }


        ?>

        </div>
        <div class="barlist">
            <div class="topmost">
               <h3> files extension allowed</h3>
               <p>only included</p>
            </div>
            <ul>
                <li>png</li>
                <li>jpg</li>
                <li>jpeg</li>
                <li>pdf</li>
            </ul>
            <hr>
        </div>

        <div class="gallery-upload">
           <div class="top-upload">
             <h3>upload image</h3>
                 <div class="bars">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                 </div>
           </div>
                <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data">
                    <input type="text" name="filename" placeholder="image name..">
                    <input type="text" name="imgtitle" placeholder="image title..">
                    <input type="text" name="imgdesc" placeholder="image description..">
                    <div class="file_upload">
                      <input type="file" name="file" id="file-input">
                      <button type="submit" class="btn" name="submit-upload">Upload</button>
                    </div>

                </form>
                <hr>

        </div>

    </div>

</section>

<?php
require_once 'requirements/footer.php';

?>
