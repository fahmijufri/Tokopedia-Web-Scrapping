<?php 
/**
 * Author 	   : Fahmi Jufri
 * Description : Curl Produk Tokopedia.com
 * Version     : 0.9
 */

class Tokopedia {

	private $html;		// HTML DOM variable
	

	public function __construct() {
		//Set time limit to 0 = infinite
		set_time_limit(0);

		// Simple HTML DOM
		require('simple_html_dom.php');
		$dom = new simple_html_dom();

		$this->html = $dom;
	}

	/**
	 * Get Owner Shop ID
	 * @param  String $name Name of the Owner Shop
	 * @return Integer $val Owner Shop ID
	 */
	public function getOwnerID($name) {
		// Load HTML DOM from url
		$html = $this->html;
		$html->load_file('https://www.tokopedia.com/'.$name);

		// Find id in input['id=shop-id']
		$nodes = $html->find('#shop-id');

		// Get input value
		foreach ($nodes as $node) {
			$val = $node->value;	
		}

		return $val;
	}

	/**
	 * Show Product from owner url between $start and $rows
	 * @param  String $name Name of the Owner Shop
	 * @param  Integer $start Shows product starting from; Default = 0
	 * @param  Integer $rows Shows maximum product; Default = 20
	 * @return JSON $data return json data from url
	 */
	public function showProduct($name, $start = 0, $rows = 20){
		// Owner Shop ID
		$id = $this->getOwnerID($name);
		// Initialize a cURL session
		$ch = curl_init();

		$header = array(
			'accept:application/json, text/javascript, */*; q=0.01',
			'accept-language:en-US,en;q=0.8,id;q=0.6,ms;q=0.4',
			'origin:https://www.tokopedia.com',
			'referer:https://www.tokopedia.com/'.$name,
			'user-agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'
		);

		// Set option for cURL
		curl_setopt_array($ch, array(
			CURLOPT_URL => "https://ace.tokopedia.com/search/v1/product?shop_id=".$id."&ob=11&start=".$start."&rows=".$rows."&full_domain=www.tokopedia.com&scheme=https&source=shop_product",
			CURLOPT_REFERER => "https://www.tokopedia.com/".$name,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTPHEADER => $header
		));

		// Check if Website can be cURL
		if (!$data = curl_exec($ch)) {
			// Website offline
			return "offline";
		} else {
			curl_close($ch);
			// return json data (products)
			return $data;
		}
	}
}

 ?>