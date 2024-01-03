<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes">

    <link rel="stylesheet" href="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/BookReader.css"/>

    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/webcomponents-bundle.js"></script>
    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/jquery-3.js"></script>


    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/BookReader.js"></script>

    <!-- Plugins -->
    <script src="<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/plugins/plugin.iframe.js"></script>

    <style>
html, body, #BookReader { width: 100%; height:100%; margin:0; padding: 0; }
    </style>
</head>
<body style="background-color: #939598;">

<div id="BookReader">
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
  bookUrl: '/zhurnal',
  bookUrlText: 'Back to yugntruf.org',
  bookUrlTitle: 'Back to Archive.org',
  
  bookLanguage: 'yi',
  pageProgression: 'rl',

  // thumbnail is optional, but it is used in the info dialog
  thumbnail: '//archive.org/download/BookReader/img/page014.jpg',
  // Metadata is optional, but it is used in the info dialog
  metadata: [
    {label: 'Title', value: 'Open Library BookReader Presentation'},
    {label: 'Author', value: 'Internet Archive'},
    {label: 'Demo Info', value: 'This demo shows how one could use BookReader with their own content.'},
  ],

  // Override the path used to find UI images
  imagesBaseURL: '<?=ARKHIV_PLUGIN_URL?>vendor/BookReader/images/',

  ui: 'full', // embed, full (responsive)

  el: '#BookReader',
};
var br = new BookReader(options);
br.init();
</script>

</body>
</html>
