<?php
class Api{

	private $apiVersion = '1.0';
	
	// Error Message on Verify Fail or System Error.
	public function errorMessage($message){
		$data = array(
	      "apiVersion" 	=> $this->apiVersion,
	      "message" 	=> $message,
	      "execute" 	=> floatval(round(microtime(true)-StTime,4)),
	     );
	    
	    // JSON Encode and Echo.
	    echo json_encode($data);
	}

	// Success Message
	public function successMessage($message,$token,$return,$dataset){

		$execute = floatval(round(microtime(true)-StTime,4));
		$data = array(
	      "apiVersion" 	=> $this->apiVersion,
	      "message" 	=> $message,
	      "token" 		=> $token,
	      "execute" 	=> $execute,
	      "data" 		=> array(
	      	'items' 		=> $dataset,
	      ),
	    );
	    
	    // JSON Encode and Echo.
	    echo json_encode($data);
	    return $execute;
	}

	// Export to json
	public function exportJson($message,$dataset){
		$data = array(
			"apiVersion" => "1.0",
			"data" => array(
				// "update" => time(),
				"time_now" => date('Y-m-d H:i:s'),
				"message" => $message,
				"execute" => round(microtime(true)-StTime,4)."s",
				"totalFeeds" => floatval(count($dataset)),
				"items" => $dataset,
			),
		);

	    // JSON Encode and Echo.
	    echo json_encode($data);
	}

	public function errorLog(){
		//Write error to text file
		//Write 2 file//Write error to text file
		//Write 2 file//Write error to text file
		//Write 2 file//Write error to text file
		//Write 2 file//Write error to text file
	}

	function jimmy(){
		$data = array(
			"apiVersion" => "1.0",
			"data" => array(
				// "update" => time(),
				"time_now" => date('Y-m-d H:i:s'),
				"message" => $message,
				"execute" => round(microtime(true)-StTime,4)."s",
				"totalFeeds" => floatval(count($dataset)),
				"items" => $dataset,
			),
		);
		
	    //Prakhan
	    echo json_encode($data);
	}
}
?>