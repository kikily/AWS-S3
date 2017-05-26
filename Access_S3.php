<?php
	//Install and initialize AWS SDK
	require 'AWSSDK/aws-autoloader.php';

	//Declare the S3Client and AwsException class
	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;

	//Build the connection to S3
	$s3Client = new Aws\S3\S3Client([
    	'version' => 'latest',
    	'region'  => AWS_S3_REGION,          //Your region
    	'credentials' => array(
        	'key'    => AWS_ACCESS_TOKEN,    //Your Access Key ID
        	'secret' => AWS_SECRET_TOKEN     //Your Secret Access Key
    	)
	]);

	//Use getIterator to get the details of files
	$iterator = $s3Client->getIterator('ListObjects', array(
    	'Bucket' => AWS_S3_BUCKET
	));

	//List files name and download links
	foreach ($iterator as $object) {
    	echo "File name is ".$object['Key']."\n";
    	echo "File link is ".$s3Client->getObjectUrl(AWS_S3_BUCKET, urldecode(FilePath), '+30 minutes');."\n";
	}

?>