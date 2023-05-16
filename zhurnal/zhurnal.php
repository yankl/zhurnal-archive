<?php
$numer = $_GET["numer"];
$uiMode = $_GET["ui"];
header('Content-Type:text/html; charset=UTF-8');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
    <title>zhurnal reader</title>
        
		<link rel="stylesheet" type="text/css" href="./BookReader/BookReader.css" id="BRCSS"/>
		
    <?php if( 'embed' == $uiMode) {
    	?>
    	    <link rel="stylesheet" type="text/css" href="BookReader/BookReaderEmbed.css"></link>
    	<?php }?>

    <!-- Custom CSS overrides -->
    <link rel="stylesheet" type="text/css" href="ZhurnalReader.css"/>

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="./BookReader/jquery-ui-1.8.5.custom.min.js"></script>

    <script type="text/javascript" src="./BookReader/dragscrollable.js"></script>
    <script type="text/javascript" src="./BookReader/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="./BookReader/jquery.ui.ipad.js"></script>
    <script type="text/javascript" src="./BookReader/jquery.bt.min.js"></script>

    <script type="text/javascript" src="./BookReader/BookReader.js"></script>
</head>

<body dir="rtl" style="background-color:  ##939598;">

<div id="BookReader">

    יוגנטרוף־זשורנאַל    <br/>
    
    <noscript>
    <p>
        The BookReader requires JavaScript to be enabled. Please check that your browser supports JavaScript and that it is enabled in the browser settings. 
    </p>
    </noscript>
</div>
<script type="text/javascript" src="ZhurnalReader.php?ui=<?php echo $uiMode ?>&numer=<?php echo $numer ?>"></script>

<div id="BRfooter">
    <div class="BRlogotype">
        <a class="BRblack">יוגנטרוף־דיגיטאַליזאַציע־פּראָיעקט </a>
    </div>
    <div class="BRnavlinks">
        <a class="BRblack" href="http://openlibrary.org/dev/docs/bookreader">Powered by Bookreader</a>
    </div>
</div>

</body>
</html>
