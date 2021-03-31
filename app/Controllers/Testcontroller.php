<?php


namespace App\Controllers;


class Testcontroller extends \CodeIgniter\Controller
{

    public function home(){

        $data["title"] = "UXWD Potluck";
        $data["content_title_1"] = "Welcome to my potluck demo site";
        $data["content_title_2"] = "Who's cooking tonight";
        $data["content"] = "Here will come some content";

        return view("template", $data);
    }

    public function about(){

        $data["title"] = "About Potluck";
        $data["content_title_1"] = "Who is who";
        $data["content_title_2"] = "Like to join the team?";
        $data["content"] = "Here will come some content";
        $data2["people"]=  array(array("name" => "Vero"), array("name" => "Koen"),array("name" => "Jeroen"));
        return view("template", $data);
    }

}