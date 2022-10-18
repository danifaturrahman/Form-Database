<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Form Regist</title>

    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
<?php
      // define variables and set to empty values
      $nameErr = $emailErr = $pesanErr = $passErr = $confpassErr = $roleErr = "";
      $name = $email = $pesan = $pass = $confpass = $role = "";
      $valid_email = $valid_name = $valid_password = $valid_role = false;
      $pass_same = $pass_notsame = "";
      $dcreated =  date('d/m/Y', time());
      $dmodif =  $dcreated;

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
          $valid_email = false;
        } else {
          $email = test_input($_POST["email"]);
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid_email = false;
          }else{
            $valid_email = true;
          }
        }

        if (empty($_POST["name"])) {
            $nameErr = "Name is Required";
            $valid_name = false;
          }else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
              $nameErr = "Only letters and white space allowed";
              $valid_name = false;
            }else{
              $valid_name = true;
            }
          }
        
        if (empty($_POST["pass"])) {
            $passErr = "Password is required";
            $valid_password = false;
          }else {
            $pass = test_input($_POST["pass"]);
            if ($_POST['pass'] == $_POST['confpass']) {
            $valid_password = true; 
          } 
            else {  
            $pass_notsame = "Password is not same";
            $valid_password = false;
            }
        }

        

        if (empty($_POST["role"])) {
            $roleErr = "Role is Required";
            $valid_role = false;
          }else {
            $role = test_input($_POST["role"]);
            $valid_role = true;
        }
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      ?>
      <div class="col-12 fs-4 fw-bold mx-4" style="color: black;">
              <p>Form Registration</p>
          </div>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="col-5 col-sm-3 mb-3 ms-5">
                <label  class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
                <span class="error">* <?php echo $emailErr;?></span>
            </div>

            <div class="col-5 col-sm-3 mb-3 ms-5">
                <label  class="form-label">Fullname</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
                <span class="error">* <?php echo $nameErr;?></span>
            </div>

            <div class="col-5 col-sm-3 mb-3 ms-5">
                <label  class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" value="<?php echo $pass;?>">
                <span class="error">* <?php echo $passErr;?></span>
            </div>

            <div class="col-5 col-sm-3 mb-3 ms-5">
                <label  class="form-label">Confirm Password</label>
                <input type="password" name="confpass" class="form-control" value="<?php echo $confpass;?>">
                <span class="error">* <?php echo $passErr;?></span>
                <span class="error"> <?php echo $pass_notsame;?></span>
            </div>

            <div class="col-5 col-sm-3 mb-3 ms-5">
                <label class="form-label">Role</label><br>
                <input type="radio" name="role" <?php if (isset($role) && $role=="Admin") echo "checked";?> value="Admin">Admin
                <input type="radio" name="role" <?php if (isset($role) && $role=="Operator") echo "checked";?> value="Operator">Operator
                <input type="radio" name="role" <?php if (isset($role) && $role=="Editor") echo "checked";?> value="Editor">Editor
                <br>
                <span class="error">* <?php echo $roleErr;?></span>
            </div>

          <input type="submit" name="submit" value="Submit" class="btn btn-success ms-5">
      </form>

        <div class="col-12 fs-5 fw-bold mx-4 ms-5" style="color: black;">
        <br>
            <p>Your Info:</p>
        </div>

        <?php
        if($valid_email && $valid_name && $valid_password && $valid_role = true){
            echo $email;
            echo "<br>";
            echo $name;
            echo "<br>";
            echo sha1($pass);
            echo "<br>";
            echo $role;
            
            include 'insertform_db.php';
        } 
        ?>
    </body>
</html>
