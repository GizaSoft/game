<?php

                    $query = "SELECT * FROM `word_list`";  // select all word
                    $search_result = filterTable($query);   // to send function to be filter

     function filterTable($query)
                {
                    include('db_connect.php');   // to connect database
                    $filter_Result = mysqli_query($db, $query);  // fetching data
                    return $filter_Result;  // to return result
                }                  
?>
<style type="text/css">
input {         /* word input */
    border: 2px solid #999;
    font-family: Helvetica, sans-serif;
    color: #999;
}

#word_field {   /* word field */
    font-family: 'Permanent Marker', 'cursive';
    font-size: 6.0em;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Game</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="header-fix fix-sidebar" style="text-align: center;
    font-family: Helvetica, sans-serif;">
    
    
    <div id="main-wrapper">
                        <h1><br><p id="definition_word"></p></h1>
                                <p id="word_field"></p>
        <form name="word_form">
            <input name="input_word" type="text" size="5" maxlength="1">
            <input name="check_word" type="button" value="Tekshiring" onClick="check_word_function()">
                <h3 style="color:red;">Kiritlgan Notog'ri Harflar:</h3>
                <h2><strong><p id="wrong_word_show"></p></strong></h2>
                <br/>
            <input name="refresh" type="button" value="Yangi Boshlash" onClick="location.reload()">
        </form>
     <?php             $t=0; 
            while($row = mysqli_fetch_array($search_result))
                                { 
                                        $count=   strlen($row['word_name']);
                                        $word_splitted =str_split($row['word_name']);  // in array

                                    for($i=0;$i<$count;$i++)
                                    {
                                        $word_array_2D[$t][$i]=$word_splitted[$i];
                                    }
                                        $word_array_2D_definition[$t]=$row['tarif'];
                        $t++;   } ?>
    </div>
</body>
</html>
                        
<script type="text/javascript">

        var wordAll=<?php echo json_encode($word_array_2D); ?>; // harflar multi arrayda
        var definitionAll=<?php echo json_encode($word_array_2D_definition);?>  // definitionAll
        
        var random = Math.floor((Math.random()*(wordAll.length-1))); 

        var word_randomly = wordAll[random]; // taxmin qilinadigan so'z yuqoridagi qatordan tanlanadi
        var definition_randomly=definitionAll[random]; // boglandi tarif bilan so'zlar random orqali
        var word_length = new Array(word_randomly.length);
        var wrong_guess = 0;

    // So'zdagi har bir harf taxmin qilingan joyning pastki chizig'i bilan ifodalanadi
    for (var i = 0; i < word_length.length; i++)
    {
            word_length[i] = "_ ";
    }

    // shablon maydonini yozadi
    function printword_length()
    {
            for (var i = 0; i < word_length.length; i++)
            {
            var word_field = document.getElementById("word_field");
            var word_to_check = document.createTextNode(word_length[i]);
                word_field.appendChild(word_to_check);
            }
                var tarif_script=word_randomly.join('');
                document.getElementById("definition_word").innerHTML=definition_randomly;
    }

    //foydalanuvchi tomonidan taqdim etilgan harfning so'zning bir yoki bir nechta harfiga mos kelishini tekshiradi
    var check_word_function = function()
    {
        var f = document.word_form; 
        var b = f.elements["input_word"]; 
        var word_tobe_checked = b.value; // foydalanuvchi tomonidan taqdim etilgan xat
        word_tobe_checked = word_tobe_checked.toUpperCase();
            for (var i = 0; i < word_randomly.length; i++)
            {
                if(word_randomly[i] === word_tobe_checked)
                {
                    word_length[i] = word_tobe_checked + " ";
                    var check_result = true;
                }
            b.value = "";
            }
    
        //tahmin maydonini o'chirib tashlaydi va uni yangi bilan almashtiradi
        var word_field = document.getElementById("word_field");
        word_field.innerHTML=""; 
        printword_length();

                // agar tahdidli maktub so'zda bo'lmasa, xat "noto'g'ri harflar" ga kiritiladi va in wrong letters
                if(!check_result)
                {
                    var wrong_word_show = document.getElementById("wrong_word_show");
                    var word_to_check = document.createTextNode(" " + word_tobe_checked);
                    wrong_word_show.appendChild(word_to_check); 
                    wrong_guess++;
                }
    
        //barcha harflar topilganligini tekshiradi
        var check_final_result = true;
            for (var i = 0; i < word_length.length; i++)
            {
                if(word_length[i] === "_ ")
                {
                    check_final_result = false;
                }
            }
                if(check_final_result)
                {

                    window.alert("Siz yutdingiz!!!");
                    window.location.reload(true);
                }
                
                //3 ta noto'g'ri harflar bor bo'lsa, yo'qotasiz
                if(wrong_guess === 3){
                   
                    window.alert("Siz yutqazdingiz.");
                    window.location.reload(true);
                }
    }

    function init()
    {
        printword_length();
    }

    window.onload = init;
</script>

 