<?php
require_once 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;

$connectionString = "https://tplivezenitheunsa.blob.core.windows.net/zenith-9ced12f3-c64b-4f44-a5f0-5b7e7e73e146";
$containerName = "https://tpuatzenitheunsa.blob.core.windows.net/zenith-1596549a-80ec-45e2-9f77-5b54ff18d4fd";
// Create blob client.
$blobClient = BlobRestProxy::createBlobService($connectionString);

try {
    // List blobs.
    $listBlobsOptions = new ListBlobsOptions();
    echo "These are the blobs present in the container: ";

    do {
        $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
        foreach ($result->getBlobs() as $blob) {
            echo $blob->getName() . ": " . $blob->getUrl() . "<br />";
        }

        $listBlobsOptions->setContinuationToken($result->getContinuationToken());
    } while ($result->getContinuationToken());
} catch (ServiceException $e) {
    // Handle exception based on error codes and messages.
    // Error codes and messages are here:
    // http://msdn.microsoft.com/library/azure/dd179439.aspx
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code . ": " . $error_message . "<br />";
}