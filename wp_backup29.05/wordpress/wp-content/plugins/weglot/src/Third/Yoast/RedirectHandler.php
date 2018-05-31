<?php

namespace Weglot\Third\Yoast;

use Weglot\Helpers\WeglotLang;
use Weglot\Helpers\WeglotUrl;

/**
 * Override Yoast Premium
 */
class RedirectHandler extends \WPSEO_Redirect_Handler{

    /**
	 * The options where the URL redirects are stored.
	 *
	 * @var string
	 */
	private $normal_option_name = 'wpseo-premium-redirects-export-plain';

	/**
	 * The option name where the regex redirects are stored.
	 *
	 * @var string
	 */
	private $regex_option_name = 'wpseo-premium-redirects-export-regex';

	/**
	 * The URL that is called at the moment.
	 *
	 * @var string
	 */
    protected $request_url = '';

    public function load() {

		// Only handle the redirect when the option for php redirects is enabled.
		if ( ! $this->load_php_redirects() ) {
			return;
		}

		// Set the requested URL.
        $this->set_request_url();

		// Check the normal redirects.
		$this->handle_normal_redirects( $this->request_url );
        
        do_action("weglot_another_redirect_override", $this->request_url);
    }

    protected function set_request_url() {
		$this->request_url = $this->get_request_uri();
    }
    
    /**
	 * Checks if the current URL matches a normal redirect.
	 *
	 * @param string $request_url The request url to look for.
	 *
	 * @return void
	 */
	protected function handle_normal_redirects( $request_url ) {
		// Setting the redirects.
        $redirects       = $this->get_redirects( $this->normal_option_name );
		$this->redirects = $this->normalize_redirects( $redirects );

		// Trim the slashes, to match the variants of a request URL (Like: url, /url, /url/, url/).
		if ( $request_url !== '/' ) {
			$request_url = trim( $request_url, '/' );
        }
        
        $redirect_url = "";

        if(isset($request_url[2]) && $request_url[2] === "/"){
            $codeLanguage = explode("/", $request_url);
            
            $langs = WeglotLang::getCodeLangs();
            if(!in_array($codeLanguage[0], $langs)){ // Default behavior Yoast
                $redirect_url = $this->find_url( $request_url );   
            }
            else{
                $redirect_url = str_replace($codeLanguage[0] . "/", "", $request_url);
                $redirect_url = $this->find_url( $redirect_url );

                if(!empty($redirect_url)){ // If find URL redirect on Yoast
                    
                    // Prepare Eligible URL from Yoast
                    $eligibleUrl = $redirect_url["url"];
                    if($eligibleUrl[0] !== "/"){
                        $eligibleUrl = "/" . $eligibleUrl;
                    }
                    if(substr($eligibleUrl, -1) !== "/"){
                        $eligibleUrl .= "/";
                    }

                    if(WeglotUrl::isEligibleURL($eligibleUrl)){
                        $redirect_url["url"] = sprintf("%s/%s", $codeLanguage[0], $redirect_url["url"]);
                    }

                }
            }
        }

		// Get the URL and doing the redirect.
		if ( ! empty( $redirect_url ) ) {
            $this->is_redirected = true;
			$this->do_redirect( $redirect_url['url'], $redirect_url['type'] );
		}
	}

}