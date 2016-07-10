<?php

class JWTLib {
	public $jwt;

	function __construct() {
		//TODO
	}

	//TODO - finish basic auth first then turn this into a helper func
	public function post_jwt() {
		//Back: authenticate user post: username, password
		//no server yet so only check password against one hash
		$password = $_POST['pwd'];
		$hash = getenv('ROOT_HASH');
		$username = getenv('ROOT_USER');
		if (!password_verify($password, $hash)) {
			$this->view->redirect('/test/loginfailed');
			return;
		}

		//Server: create jwt token with secret
		$tokenId    = base64_encode(mcrypt_create_iv(32));
		$issuedAt   = time();
		$notBefore  = $issuedAt + 10;             //Adding 10 seconds
		$expire     = $notBefore + 60;            // Adding 60 seconds
		$serverName = getenv('ENVIRONMENT_HOST'); // Retrieve the server name from config file

		$data = [
			'iat'  => $issuedAt,         // Issued at: time when the token was generated
			'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
			'iss'  => $serverName,       // Issuer
			'nbf'  => $notBefore,        // Not before
			'exp'  => $expire,           // Expire
			'data' => [                  // Data related to the signer user
				'userId'   => $rs['id'], // userid from the users table
				'userName' => $username, // User name
			]
		];

		$secretKey = getenv('SECRET_KEY');
		$jwt = JWT::encode(
			$data,      //Data to be encoded in the JWT
			$secretKey, // The signing key
			'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
		);

		$unencodedArray = ['jwt' => $jwt];
		echo json_encode($unencodedArray);

		
		//Forward: return jwt to client
		//

		//Back: send previously acquired jwt
		//Server: check sent jwt, verify and get user info
		//Forward: send response to client

		echo $hashed = password_hash($user_password, PASSWORD_BCRYPT);
		echo $res = password_verify($user_password, $hashed) ? "yes" : "no";
	}
}

?>