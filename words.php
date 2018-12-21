<?php
    include('server.php');

       if(empty($_SESSION['login']))
        {
          header('Location:page-login.php');
        }
       if(isset($_SESSION['login'])) 
        {
                                $query = "SELECT * FROM `word_list`"; 
                                $search_result = filterTable($query);
        }   

     function filterTable($query)
                {
                    include('db_connect.php');
                    $filter_Result = mysqli_query($db, $query);
                    return $filter_Result;
                }     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Words</title>   
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="header-fix fix-sidebar">  
    <div id="main-wrapper">             
        <div class="left-sidebar">               
               <?php 
                include('header.php');
               ?>
        </div>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">So'zlar ro'yxati</h4>
                                <a href="action_word/create.php" class="btn btn-success pull-right">Yangi so'zni kiritish</a>
                                <br>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>So'z nomi</th>
                                                <th>Ta'rif</th>
                                                <th>Xarakatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                    <?php $t = 1;?>
                    <?php while($row = mysqli_fetch_array($search_result))
                            {  
                               
                    ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $row['word_name']; ?></td>
                            <td><?php echo $row['tarif']; ?></td>
                            <td>
                               <a href="action_word/delete.php?id=<?php echo $row['id']; ?>" title='Delete_word' data-toggle='tooltip'><span class='fa fa-trash' style="font-size: 20px;"></span></a>
                            </td>
                        </tr>
                             
                    <?php $t++; } ?>               
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>   
</body>
</html>