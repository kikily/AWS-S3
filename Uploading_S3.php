<?php
	//Install and initialize AWS SDK
	require 'AWSSDK/aws-autoloader.php';

	//Declare the S3Client and S3Exception class
	use Aws\S3\S3Client;
	use use Aws\S3\Exception\S3Exception;

	//Build the connection to S3
	$s3Client = new Aws\S3\S3Client([
    	'version' => 'latest',
    	'region'  => AWS_S3_REGION,          //Your region
    	'credentials' => array(
        	'key'    => AWS_ACCESS_TOKEN,    //Your Access Key ID
        	'secret' => AWS_SECRET_TOKEN     //Your Secret Access Key
    	)
	]);

	//check whether the file is uploaded or not
	if (isset($_FILES['file'])){
		$file = $FILES['file'];
		$file_name = $file['name'];

		try {
			$s3Client->putObject(array(
			    'Bucket' => AWS_S3_BUCKET,
			    'Key'    => $file_name,                 //Your file name
			    'Body'   => fopen($pathToFile, 'r+')    //Your file path
			));
		} catch(S3Exception $e) {
			echo 'Uploading fail!!!'
		}
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Uploading files</title>
	</head>
	<body>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="file">
			<input type="submit" value="Upload">
		</form>
	</body>
</html>