<?php
$numer = $_GET["numer"]
?>

var uiMode = '<?php echo $_GET["ui"] ?>';

// 
// This file provides the code to initialize the BookReader object
//

// Create the BookReader object
br = new BookReader();

// all zhurnaln are right-to-left:
br.pageProgression = 'rl';

//embed option
if ('embed'==uiMode) {
		br.ui = 'embed';
	}

// Assuming PNG's have been resized to width 1000px and height 1468px
br.getPageWidth = function(index) {
    return 1000;
}

br.getPageHeight = function(index) {
    return 1468;
}

br.getPageURI = function(index, reduce, rotate) {
    var page = index + 1;
    var url = 'img/YR.<?php echo $numer ?>.' + page.toString() + '.png'; 
    return url;
}

// Return which side, left or right, that a given page should be displayed on
br.getPageSide = function(index) {
    if ('rl' == this.pageProgression) {index = index + 1}
    if (0 == (index & 0x1)) {
        return 'R';
    } else {
        return 'L';
    }
}

// This function returns the left and right indices for the user-visible
// spread that contains the given index.  The return values may be
// null if there is no facing page or the index is invalid.
br.getSpreadIndices = function(pindex) {   
    var spreadIndices = [null, null]; 
    if ('rl' == this.pageProgression) {
        // Right to Left
        if (this.getPageSide(pindex) == 'R') {
            spreadIndices[1] = pindex;
            spreadIndices[0] = pindex + 1;
        } else {
            // Given index was LHS
            spreadIndices[0] = pindex;
            spreadIndices[1] = pindex - 1;
        }
    } else {
        // Left to right
        if (this.getPageSide(pindex) == 'L') {
            spreadIndices[0] = pindex;
            spreadIndices[1] = pindex + 1;
        } else {
            // Given index was RHS
            spreadIndices[1] = pindex;
            spreadIndices[0] = pindex - 1;
        }
    }
    
    return spreadIndices;
}

// For a given "accessible page index" return the page number in the book.
//
// For example, index 5 might correspond to "Page 1" if there is front matter such
// as a title page and table of contents.
br.getPageNum = function(index) {
    return index+1;
}

// Total number of leafs
br.numLeafs = <?php
// this code finds the max page for the given issue
$searchstring = 'img/YR.' . $numer . '.*.png';
foreach (glob($searchstring) as $filename) {
    //the pages are found between the second and third periods in the filename
    $pieces = explode('.', basename($filename));
    $pages[] = intval($pieces[2]);
}
echo (max($pages));
?>;

// Book title and the URL used for the book title link
br.bookTitle= 'יוגנטרוף־זשורנאַל נומער ‏' + '<?php echo $numer ?>';
br.bookUrl = 'zhurnal.php?numer=<?php echo $numer ?>#mode/2up';

// Override the path used to find UI images
br.imagesBaseURL = 'BookReader/images/';

br.onePage = {
	autofit: 'width'
};

br.getEmbedCode = function(frameWidth, frameHeight, viewParams) {
    return "Embed code not supported in bookreader demo.";
}

// Let's go!
br.init();

// read-aloud and search need backend compenents and are not supported in the demo
$('#BRtoolbar').find('.read').hide();
$('#textSrch').hide();
$('#btnSrch').hide();
