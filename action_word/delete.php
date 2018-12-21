<?php
    include('../db_connect.php');

        if(isset($_POST["submit"]) && !empty($_POST["submit"]))
        {
                $id_word = $_POST["id"];
                $sql1 = "DELETE FROM `word_list` WHERE id = '$id_word'";
                
            if($stmt = mysqli_prepare($db, $sql1))
            {
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                $param_id = trim($_POST["id"]);

                if(mysqli_stmt_execute($stmt))
                    {
                        header("location: ../words.php");
                        exit();
                    } 
                else
                    {
                        echo "Xatolik bor o'chirishda.";
                    }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($db);
        } 
        else
            {
            if(empty($_GET["id"]))
                {
                    header("location: error.php");
                    exit();
                }
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>O'chirish</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>So'zni o'chirish</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>"/>
                            <p>So'zni o'chirishni tasdiqlaysizmi ?</p><br>
                            <p>
                                <input type="submit" value="Ха" class="btn btn-danger" name="submit">
                                <a href="../words.php" class="btn btn-default">Yo'q</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>