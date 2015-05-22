<?php
/**
 * Created by HoaNX <xuanhoapro@gmail.com>
 * Date: 5/22/15
 */
//require 'google-api-php-client/src/Google/autoload.php';
//require 'google-api-php-client/autoload.php';

//require_once realpath(dirname(__FILE__).'/google-api-php-client/src/Google/autoload.php');

//require_once dirname(__FILE__).'/google-api-php-client/src/Google/Client.php';
//require_once dirname(__FILE__).'/google-api-php-client/src/Google/Config.php';
//require_once dirname(__FILE__).'/google-api-php-client/src/Google/Auth/OAuth2.php';
//require_once dirname(__FILE__).'/google-api-php-client/src/Google/Auth/Abstract.php';

class YiiGoogleApi extends CApplicationComponent {
    // Credentials can be obtained at https://code.google.com/apis/console
    // See http://code.google.com/p/google-api-php-client/wiki/OAuth2 for more information
    public $clientId = null;
    public $clientSecret = null;

    // Make sure that this matches a registered redirect URI for your app
    public $redirectUri = null;

    // This is the API key for 'Simple API Access'
    public $developerKey = null;

    public $client = null;

    public function init(){
        $path = dirname(__FILE__) . '/google-api-php-client/src';
        set_include_path(get_include_path() . PATH_SEPARATOR . $path);

//        require_once realpath(dirname(__FILE__).'/google-api-php-client/src/Google/autoload.php');

        parent::init();
    }

} 