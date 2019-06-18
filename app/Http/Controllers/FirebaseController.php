<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    public function index(){
        $database = $this->connectionFirebase()->getDatabase();
        $newPost = $database
            ->getReference('box');
        echo"<pre>";
        print_r($newPost->getvalue());
    }

    public function insert(){
        $database = $this->connectionFirebase()->getDatabase();
        $newPost = $database
            ->getReference('box')
            ->push(['title' => 'Post title','body' => 'This should probably be longer.']);
        echo"<pre>";
        print_r($newPost->getvalue());
    }

    private function connectionFirebase(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/nodabox-820a8-firebase-adminsdk-7xtg4-ddaced3ef7.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://nodabox-820a8.firebaseio.com')
            ->create();
        return $firebase;
    }
}
