import os
from azure.identity import ClientSecretCredential
from azure.storage.blob import ContainerClient

try:
    print("Azure Blob Storage Python quickstart sample")
    containerUri = "https://tplivezenitheunsa.blob.core.windows.net/zenith-9ced12f3-c64b-4f44-a5f0-5b7e7e73e146"
    tenantId = "b958889c-3b36-45ec-ab56-b88c1a427797"
    clientId = "79f0de9f-b31c-40ae-96c8-35ed73ba6117"
    clientSecret = "fb88Q~5hECo7Xgh09ajbugY~Wwcp.Kjrbav9ec4r"
    blobContainerClient = ContainerClient.from_container_url(containerUri, ClientSecretCredential(tenantId, clientId, clientSecret))
    blobs = blobContainerClient.list_blobs();
    local_path = "./data"
    os.mkdir(local_path)

    for blob in blobs:
        download_file_path = os.path.join(local_path, blob.name)
        print("\nDownloading \n\t" + blob.name)
        with open(file=download_file_path, mode="wb") as download_file:
         download_file.write(blobContainerClient.download_blob(blob.name).readall())
except Exception as ex:
    print('Exception:')
    print(ex)