<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Application</title>
</head>
<body>
    <div class="base" style="padding-top:0.001%;">
        <div class="output">
            <p style='margin-right:5%; overflow:hidden;'>
            <?php
            session_start();

            if(!isset($_SESSION["output"]))
            {
                $_SESSION["output"] = "";
            }


            $value;
            $output = $_SESSION["output"];
            $display = "0";
            $number_array = array('0','1','2','3','4','5','6','7','8','9');
            $calc_array = array('0','1','2','3','4','5','6','7','8','9','-','+','*','/','(',')','.');
            if(isset($_GET['number']))
            {
                $lc_output = substr($output,offset: -1,length: 1);
                if($output == "0")
                {
                    $output = $_GET['number'];
                }
                else if((in_array($lc_output, $calc_array) == false))
                {
                    $output = $_GET['number'];
                }
                else{
                    $output .= $_GET['number'];
                }
            }

            if(isset($_GET['clear_all']))
            {
                $output = 0;
            }

            if(isset($_GET['operator']))
            {
                $lc_output = substr($output,offset: -1,length: 1);

                if(in_array($lc_output, $calc_array) == false)
                {
                    $output = $_GET['operator'];
                }
                else
                {
                    $output .= $_GET['operator'];
                }
            }
            if(isset($_GET['clear_latest']))
            {
                $fc_output = substr($output,offset: 0,length: 1);
                $lc_output = substr($output,offset: -1,length: 1);
                if(in_array($lc_output, $calc_array) == false || in_array($fc_output, $calc_array) == false)
                {
                    $output = 0;
                }

                if (substr($output, 0, -1) == ''){
                    $output = 0;
                }
                else{$output = substr($output, 0, -1);}
            }


            if(isset($_GET['calculate']))
            {
                // Calculate the output. Account for any errors as well
                $lc_output = substr($output,offset: -1,length: 1);
                if(in_array($lc_output, $number_array) == true)
                {
                    $value = eval('return ' . $output . ';');
                }
                else
                {
                    $value = "ERROR!";
                    //$value = 0;
                }

                $lc_output = "";

                $output = $value;
            }

            $_SESSION["output"] = $output;

            if(!empty($output))
            {
                $display = $output; // let's constantly set the output to the display.
            }
            echo"$display";
            ?>
            </p>
        </div>

        <div class="input_buttons">
            <form action="index.php" method="get">
                <input type="submit" value="C" class="button" name="clear_all" id="clear_all">
                <input type="submit" value="CE"class="button special" name="clear_latest">
                <input type="submit" value=")" class="button special" name="number">
                <input type="submit" value="(" class="button special" name="number">
                <input type="submit" value="-" class="button" name="operator" id="minus">
                <input type="submit" value="9" class="button" name="number">
                <input type="submit" value="8" class="button" name="number">
                <input type="submit" value="7" class="button" name="number">
                <input type="submit" value="/" class="button" name="operator" id="divide">
                <input type="submit" value="6" class="button" name="number">
                <input type="submit" value="5" class="button" name="number">
                <input type="submit" value="4" class="button" name="number">
                <input type="submit" value="*" class="button" name="operator" id="multiply">
                <input type="submit" value="3" class="button" name="number">
                <input type="submit" value="2" class="button" name="number">
                <input type="submit" value="1" class="button" name="number">
                <input type="submit" value="+" class="button" name="operator" id="addition">
                <input type="submit" value="=" class="button special" name="calculate">
                <input type="submit" value="0" class="button" name="number">
                <input type="submit" value="." class="button" name="number">
            </form>
        </div>
    </div>
</body>
</html>