<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Drive;

class IndexController extends Controller
{
    public function uploadFileToDrive(Request $request)
    {
        // return $request->all();

        $file = $request->file('file');
        $fileContents = file_get_contents($file->getRealPath());
        // return $fileContents;

        $client = new Google_Client();

        $client->setApplicationName('My App');

        $client->setScopes(Google_Service_Drive::DRIVE);
        // $client->setAuthConfig('/path/to/client_secret.json');
        $client->setAuthConfig(storage_path(
            'app/client_secret.json'
            ));

        $client->setAccessType('offline');

        $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

        $client->setAccessToken($accessToken);


        // Create new Drive client


        $driveService = new Google_Service_Drive($client);


        // Create new Drive file object


        $fileMetadata = new Google_Service_Drive_DriveFile(array('name'=>$file->getClientOriginalName(),

        'description'=>'My uploaded file',

        'mimeType'=> $file->getClientMimeType()));


        // Upload file to Google Drive


        $file = $driveService->files->create($fileMetadata,array(

            'data'=> $fileContents,

            'mimeType'=> $file->getClientMimeType(),

            'uploadType'=>'multipart'
            )
            );


        // Print the file ID of the newly uploaded file


        echo "File ID: ".$file->getId();
    }
}
