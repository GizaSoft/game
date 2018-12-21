<?php
    include('../db_connect.php');

            $word_enter = $word_definition="";
            $word_enter_err =$word_definition_err="";

    if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $input_word_enter = ($_POST["word_enter"]);
            if(empty($input_word_enter))
                {
                    $word_enter_err = "So'zni kiriting.";     
                } 
            else
                {
                    $word_enter = $input_word_enter;
                }

                $input_word_definition = ($_POST["word_definition"]);
            if(empty($input_word_definition))
                {
                    $word_definition_err = "So'z tarifini kiriting.";     
                } 
            else
                {
                    $word_definition = $input_word_definition;
                }
        
        if(empty($word_enter_err)&&empty($word_definition_err))
            {
                $check_word_definitionber = $db->query("SELECT * FROM `word_list` WHERE word_name = '$word_enter'");
            if($check_word_definitionber->num_rows == 0)
                {
                    $sql = "INSERT INTO `word_list`(`word_name`,`tarif`) VALUES ('$word_enter','$word_definition')";
                } 
            else
                {
                    echo "Siz kiritgan So'z mavjud!!";
                }
                    $db->query($sql);
                    header("location: ../words.php");
                    exit();
                }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Yangi so'z</title>
    <link href="../css/style.css" rel="stylesheet">
</head>

<body class="header-fix fix-sidebar">
        <div class="page-wrapper" style="margin-left: 550px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 responsive-md-100">
                        <div class="card card-outline-primary">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"><center>Yangi so'z kiriting!</center></h4>
                            </div>
                            <div class="card-body">
                                  <form class="form p-t-20" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <hr>
                                    <div class="form-group  <?php echo (!empty($word_enter_err)) ? 'has-error' : ''; ?>">
                                        <label for="exampleInputEmail1">So'z nomi</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-world"></i></div>
                                        <input type="text" name="word_enter" class="form-control form-type"  value="<?php echo $word_enter; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group  <?php echo (!empty($word_definition_err)) ? 'has-error' : ''; ?>">
                                        <label for="exampleInputEmail1">So'z tarifi</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="ti-world"></i></div>
                                        <input type="text" name="word_definition" class="form-control form-type" value="<?php echo $word_definition; ?>">
                                        <!-- <span class="help-block"><?php echo $word_enter_err;?></span> -->
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>Tasdiqlash</button>
                                    <a href="../words.php" class="btn btn-inverse waves-effect waves-light">Bekor qilish</a>
                                </form>       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
</body>
</html>