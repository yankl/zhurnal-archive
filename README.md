# Installation

After cloning the repo the following files have to be filled in:

1. Run `composer update` for various PHP dependencies. 
2. Copy subdirectory BookReader from https://github.com/internetarchive/bookreader into '/vendor'. Most recently tested version is 5.0.0-77. 
3. Images can be found on Yugntruf shared Google drive in אַרכיװ > זשורנאַל. Put the `.png`s in a subdirectory `/assets`.
4. Credentials for the service account needed to access Google Sheets can be downloaded from Google [see here](https://developers.google.com/workspace/guides/create-credentials#service-account). The file should be saved under `creds/credentials.json`.

The resulting folder should be installed as a Wordpress plugin on the site. 

Finally, the article index can be generated in the WP admin backend by clicking on the sync button.