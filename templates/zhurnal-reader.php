<div class='zhurnal-reader-container'>
    <link rel="stylesheet" href="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/BookReader.css"/>

    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/webcomponents-bundle.js"></script>
    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/jquery-3.js"></script>


    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/BookReader.js"></script>

    <!-- Plugins -->
    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/plugins/plugin.url.js"></script>

    <style>
html, body, #BookReader { width: 100%; height:100%; margin:0; padding: 0; }
    </style>


<div id="BookReader" dir='ltr'>
  זשורנאַל־לײענער<br/>

  <noscript>
  <p>
      The Zhurnal Reader requires JavaScript to be enabled. Please check that your browser supports JavaScript and that it is enabled in the browser settings.
  </p>
  </noscript>
  </div>


<script type="text/javascript">
var options = {
	
  showLogo: false,
  
  data: <?=$data?>,
  
  // Book title and the URL used for the book title link
  bookTitle: '<?=$title?>',
  bookUrl: '.',
  bookUrlText: 'יוגנטרוף־אַרכיװ',
  bookUrlTitle: 'יוגנטרוף־אַרכיװ',
  
  bookLanguage: 'yi',
  pageProgression: 'rl',

  // Override the path used to find UI images
  imagesBaseURL: '<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/images/',

  ui: 'full', // embed, full (responsive)

  el: '#BookReader',
  
    /** Object to hold parameters related to 1up mode */
  onePage: {
    /** @type {AutoFitValues} */
    autofit: 'width',
  },
  
  startFullscreen: true,
};
var br = new BookReader(options);
br.init();
</script>
</div>