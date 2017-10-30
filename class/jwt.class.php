<?php
require __DIR__ . '/vendor/autoload.php';
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Keychain; // just to make our life simpler
use Lcobucci\JWT\Signer\Rsa\Sha256; // you can use Lcobucci\JWT\Signer\Ecdsa\Sha256 if you're using ECDSA keys
class Jwt{
	private $token;
	private $signer;
	private $keychain;

	public function __construct(){
		$this->signer = new Sha256();
		$this->keychain = new Keychain();
	}
	// verify from token string
	public function verify($data){
		if(!isset($data) || $data == '')return false;
		$key = file_get_contents(__DIR__.'/keys/student.pub');
		$token = (new Parser())->parse((string) $data);
		if(!$token->verify($this->signer, $this->keychain->getPublicKey($key))){
			//invalid token with sign
			return false;
		}
		if($token->isExpired()){
			//is expired
			return false;
		}

		return $token->getClaim('app_token');
	}

	//This example for create token with rsa
	public function createToken($name, $value){
		$this->token = (new Builder())
                        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                        ->setExpiration(time() + 60) // Configures the expiration time of the token (nbf claim)
                        ->set($name, $value)
                        ->sign($this->signer,  $this->keychain->getPrivateKey(file_get_contents(__DIR__.'/keys/student.key'))) // creates a signature using your private key
                        ->getToken(); // Retrieves the generated token
		return $this->token;
	}
}