<?php


namespace App\Controllers;
use App\Models\AchieveModel;
use App\Models\TaskModel;
use App\Models\uploadModel;
use App\Models\UserModel;
use App\Models\MarkerModel;
use App\Models\leaderboardModel;
use App\Models\followingModel;


class Snapp extends \CodeIgniter\Controller
{
    private $data;
    private $pass_data;
    private $img_data;
    private $post_data;
    private $empty_image_alert;
    private $leaderboard_data;
    private $user_data=[];
    private $task_data;

    public function index(){
        return redirect()->to('activity');
    }

    public function activity(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->data["stylesheets_to_load"] = array("activity_page.css");
        $this->pass_data["active_navbar_item"] = "activity";
        $this->data["navbar"] = view("navbar", $this->pass_data);
        $this->data["topbar"] = $this->load_topbar();
        $this->data["page_title"] =lang('text.activity');

        if(! session()->get('isLoggedIn')){
            $this->data["scripts_to_load"] = array('jquery-3.5.1.js','activity_nearby.js','observation_details.js');
            $this->activity_nearby();
            $this->pass_data["tab_names"]= array(lang('text.nearby'),lang('text.map'));
            $this->pass_data["tab_contents"] = array(view("activity_nearby"),view("nearby_map_page"));
            $this->data["page_content"] = view("tabs_template",$this->pass_data);
            return view("mobile_template",$this->data);
        }
        else{
            $this->data["scripts_to_load"] = array('jquery-3.5.1.js','activity_nearby.js','activity_following.js','observation_details.js');
            $this->activity_following();
            $this->activity_nearby();
            $this->pass_data["tab_names"]= array(lang('text.nearby'),lang('text.following'),lang('text.map'));
            $this->pass_data["tab_contents"] = array(view("activity_nearby"),view("activity_following"),view("nearby_map_page"));
            $this->data["page_content"] = view("tabs_template",$this->pass_data);
            return view("mobile_template",$this->data);
        }
    }

    public function activity_nearby(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        helper('array');
        $db      = \Config\Database::connect();
        if(! session()->get('isLoggedIn')){
            $this->data['session'] = "0";
        }
        else{
            $this->data['session'] = "1";
        }
        $outputtype = $this->request->getVar('output');

        if(strcasecmp($outputtype, 'nearbyData') == 0){

            $offset = $_COOKIE["element_amount_n"];
            $this->data["post_type"] = "n_";
            $this->data["offset"] = $offset;
            $cards_per_page = $_COOKIE["increment_amount_n"];
            $query_text_ajax = 'select user_id,icon,username,common_name,picture,comment,location_city,time,scientific_name,wiki_url from users inner join upload where iduser = user_id order by upload.time DESC, user_id ASC limit '.$cards_per_page.' offset '.$offset;
            $this->data['posts'] = $db->query($query_text_ajax)->getResultArray();
            $this->data["profile_picture"] = "/Assets/blank-profile.svg";
            $content =  view('ajax_posts',$this->data);
            return $content;
        }
        else {
            $offset= 0;
            $this->data["offset"] = $offset;
            $cards_per_page = 4;
            $query_text = 'select user_id,icon,username,common_name,upload.picture,upload.comment,location_city,upload.time,upload.scientific_name,wiki_url from users inner join upload where iduser = user_id order by upload.time DESC,user_id ASC limit ? offset ? ';
            $query_count = 'select count(*) as num from users inner join upload where iduser = user_id';
            $this->data['n_total_num'] = dot_array_search('num', $db->query($query_count)->getRowArray(0));
            $this->data['n_uploads'] = $db->query($query_text,[$cards_per_page,$offset])->getResultArray();
            $this->data["profile_picture"] = "/Assets/blank-profile.svg";
            return view('activity_nearby',$this->data);
        }
    }

    public function activity_following(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $db      = \Config\Database::connect();
        $this->data["stylesheets_to_load"] = array("activity_page.css");
        $this->data["navbar"] = view("navbar");
        $this->data["topbar"] = $this->load_topbar();
        $this->data["page_title"] =  lang('text.activity');

        $outputtype = $this->request->getVar('output');
        if(! session()->get('isLoggedIn')){
            $this->data['session'] = "0";
        }
        else{
            $this->data['session'] = "1";
        }

        $user_id = session()->get('id');
        if(strcasecmp($outputtype, 'followingData') == 0){
            $offset = $_COOKIE["element_amount_f"];
            $this->data["post_type"] = "f_";
            $this->data["offset"] = $offset;
            $cards_per_page = $_COOKIE["increment_amount_f"];
            $sql ='select user_id,icon,username,common_name,comment,location_city,time,scientific_name,picture,wiki_url from upload join users where user_id = iduser having user_id in (select target_id from follow where user_id = ?) order by upload.time desc,user_id ASC limit '.$cards_per_page.' offset '.$offset;
            $this->data['posts'] = $db->query($sql,[$user_id])->getResultArray();
            $this->data["profile_picture"] = "/Assets/blank-profile.svg";
            $content =  view('ajax_posts',$this->data);
            return $content;
        }
        else {
            $offset= 0;
            $cards_per_page = 4;
            $query_text = 'select user_id,icon,username,common_name,comment,location_city,time,scientific_name,picture,wiki_url from upload join users where user_id = iduser having user_id in (select target_id from follow where user_id = ?) order by upload.time desc,user_id ASC limit ? offset ?';
            $query_count = 'select count(*) as num from upload where user_id in (select target_id from follow where user_id = ?) ';
            $this->data['f_total_num'] = dot_array_search('num', $db->query($query_count,[$user_id])->getRowArray(0));
            $this->data['f_uploads'] = $db->query($query_text,[$user_id,$cards_per_page,$offset])->getResultArray();
            $this->data["profile_picture"] = "/Assets/blank-profile.svg";
            return view('activity_following',$this->data);
        }
    }

    public function diary($id=-1){
        $db      = \Config\Database::connect();

        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->data["scripts_to_load"] = array('jquery-3.5.1.js','observation_details.js','diary.js');
        $this->data["stylesheets_to_load"] = array("activity_page.css","diary.css");

        if($id==-1) {
            $user_id = session()->get('id');
            $this->pass_data["active_navbar_item"] = "diary";
            $this->data["page_title"] = lang('text.diary');
            $this->data["navbar"] = view("navbar",$this->pass_data);
        }
        else {
            $user_id = $id;
            $this->data["navbar"] = view("navbar");

            $query_text_name ='select username from users where iduser = '.$id;
            $name_for_this_person = dot_array_search('username', $db->query($query_text_name)->getRowArray(0));

            $title = $name_for_this_person."'s Observations";
            $this->data["page_title"] = $title;
        }
        $this->post_data["username"] = session()->get('username');
        $upload_model = new uploadModel();
        $this->post_data["uploads"] = $upload_model->where('user_id', $user_id)->orderby('time','DESC')
                ->findAll();


        $this->data["topbar"] = $this->load_topbar();


        //$this->post_data["profile_picture"] = "/Assets/blank-profile.svg";
        $this->data["page_content"] = view("diary",$this->post_data);
        return view("mobile_template",$this->data);
    }

    public function tasks(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }

        $this->pass_data["active_navbar_item"] = "tasks";
        $this->data["navbar"] = view("navbar",$this->pass_data);
        $this->data["topbar"] = $this->load_topbar();

        $this->data["page_title"] = lang('text.tasks');

        $this->task_data["user_id"] = session()->get('id');
        $this->pass_data["tab_contents"] = array(view("task_page.php", $this->task_data));
        $this->pass_data["tab_names"]= array(lang('text.weekly'),lang('text.monthly'));

        $this->data["scripts_to_load"] = array('jquery-3.5.1.js','task_page.js');
        $this->data["page_content"] = view("tabs_template",$this->pass_data);


        $this->db = \Config\Database::connect();

        $outputtype = $this->request->getVar('output');
        if(strcasecmp($outputtype, 'json') == 0){

            $db      = \Config\Database::connect();
            $query_text = ' SELECT idtask, name, location, duetime, description, active, progress, weekly, monthly, idachieve, user_id, task_id, iduser, username
                            FROM task 
                            LEFT OUTER JOIN achieve
                                ON task.idtask = achieve.task_id
                            LEFT OUTER JOIN users
                                ON users.iduser = achieve.user_id
                            WHERE active = 1';

            $tasks = $db->query($query_text)->getResult();

            return $this->response->setJSON($tasks);

        }


        return view("mobile_template",$this->data);
    }


    public function leaderboard(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->pass_data["active_navbar_item"] = "leaderboard";
        $this->data["stylesheets_to_load"] = array("leaderboard_style.css");
        $this->data["navbar"] = view("navbar",$this->pass_data);
        $this->data["topbar"] = $this->load_topbar();
        $this->data["page_title"] = lang('text.leaderboard');

        $db      = \Config\Database::connect();
        $query_text="SELECT u.iduser,u.username,p.count,u.icon from users u join
(SELECT b.user_id,count(*) as count FROM users a left join upload b on a.iduser=b.user_id where b.user_id>1
group by b.user_id order by count(*) desc limit 10) p
on u.iduser=p.user_id
order by p.count desc";
        $query_text_2="SELECT max(count) as max
FROM (SELECT count(*) count FROM a20ux5.upload where user_id>1 group by user_id) a";
        $query_result = $db->query($query_text)->getResult();
        $query_result_2 = $db->query($query_text_2)->getFirstRow();
        $this->leaderboard_data["topTen"]=$query_result;
        $this->leaderboard_data["maxCount"]=$query_result_2;
        $this->data["page_content"]=view("leaderboard",$this->leaderboard_data);


        return view("mobile_template",$this->data);
    }

    private function encodeImages($images){
        $encoded_images = array();
        foreach($images as $image){
            $encoded_images[] = base64_encode(file_get_contents($image));
        }
        return $encoded_images;
    }

    private function identifyPlants($images){
        $encoded_images=$this->encodeImages($images);
        $api_key = "r2dtCekIqnRQMjzdfZoHw7UtURpRMBgMvFsZ5FuMSRK3bh2IkP";
        //we can put all of our api keys into an array, the code can just use the next one
        //in case there is a problem with one (for example the quota is filled for the api)
        $params = array(
            "api_key" => $api_key,
            "images" => $encoded_images,
            "modifiers" => ["crops_fast","similar_images"],
            "plant_language" => "en",
            "plant_details" => array("common_names",
                "url",
                "name_authority",
                "wiki_description",
                "taxonomy",
                "synonyms"),
        );
        $params = json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.plant.id/v2/identify");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    public function addObservation(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->data["topbar"] = view("add_obs_topbar");
        $this->data["page_non_scrollable"] = True;
        $this->data["page_title"] = lang('text.add_observation');
        $this->empty_image_alert["empty_image"]=0;
        $this->data["page_content"] = view("add_obs_picture",$this->empty_image_alert);

        if ($this->request->getMethod() == 'post') {
            $model = new uploadModel();
            if(isset($_POST['species']))
            {
            //This if clause corresponds to confirm observation page, which uploads all information about this observation into database

                //if this observation is uploaded by a guest, user id would be set as 1
                if((session()->get('id'))!=NULL) {
                    $user_id = session()->get("id");
                }
                else{
                    $user_id=1;
                }

                //date is autofilled by today's date
                //this array stores all data that would be uploaded into database
                $newData = [
                        'user_id' => $user_id,
                        'common_name' => $this->request->getVar('common_name'),
                        'scientific_name' => $this->request->getVar('scientific_name'),
                        'picture' => $this->request->getVar('imgSrc'),
                        'location_city' => $this->request->getVar('location_address'),
                        'coordinate' => $this->request->getVar('location'),
                        'time' => $this->request->getVar('time'),
                        'comment' => $this->request->getVar('comment'),
                        'only_in_diary'=>0,
                        'wiki_url'=>$this->request->getVar('wiki_url')
                    ];
                if(!empty($_POST["no_location_checkbox"]))
                {
                    $newData['location_city']=null;
                    $newData['coordinate']=null;
                }
                if(!empty($_POST["only_diary"]))
                {
                    $newData['only_in_diary']=1;
                }
                $model->insert($newData);
                $insert_id=$model->getInsertID();

                $this->pass_data["picture"]=$this->request->getVar('return_img');
                $this->pass_data["insert_id"]=$insert_id;

                $this->data["navbar"] = view("navbar");
                $this->data["topbar"] = $this->load_topbar();
                $this->data["page_title"] = lang('text.result');
                $this->data["stylesheets_to_load"] = array("obs_result.css");
                $this->data["page_non_scrollable"] = False;

                $this->pass_data["scientific_name"] = $this->request->getVar('scientific_name');
                $this->pass_data["wiki_url"] = $this->request->getVar('wiki_url');
                $this->pass_data["wiki_description"] = $this->request->getVar('wiki_description');

                $this->data["page_content"] = view("add_observation_result",$this->pass_data);

                //in this if statement, it is checked if a task is completed by the uploading of a picture
                if($user_id!=1){
                    $taskmodel = new TaskModel();
                    $tasks= $taskmodel->where('active', 1)->findAll();

                    foreach($tasks as $key => $value){

                        if(strpos($this->request->getVar('scientific_name'),$value['name']) !== false){
                            $achieve_model = new AchieveModel();
                            $achieve_data = [
                                'user_id' => $user_id,
                                'task_id' => $value['idtask']
                            ];
                            $achieve_model->insert(($achieve_data));
                        }
                    }
                }

                return view("mobile_template", $this->data);

            }
            else if(isset($_POST['add_obs_picture_flag'])){
                // this if clause corresponds to add observation page, sending request to planID
                    $target_file = basename($_FILES["picture"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $this->img_data["imageFileType"] = $imageFileType;
                    $extensions_arr = array("jpg", "jpeg", "png", "gif");

                    if (in_array($imageFileType, $extensions_arr)) {
                        $imgFile = $_FILES['picture']['tmp_name'];
                        $imgData = base64_encode(file_get_contents($imgFile));
                        $imgDate = date("Y-m-d");

                        $result = $this->identifyPlants([$imgFile]);
                        $this->pass_data["result"] = $result;
                        $result_array = json_decode($result, true);
                        $plant_detail_array = $result_array['suggestions'][0]['plant_details'];
                        if (array_key_exists('common_names', $plant_detail_array) && $plant_detail_array['common_names'] != NULL) {
                            $this->pass_data["plant_name"] = $plant_detail_array['common_names'][0];
                            $this->pass_data["common_name"]= $plant_detail_array['common_names'][0];
                        } else {
                            $this->pass_data["plant_name"] = $result_array['suggestions'][0]['plant_name'];
                            $this->pass_data["common_name"]= NULL;
                        }
                        $this->pass_data["scientific_name"]=$result_array['suggestions'][0]['plant_name'];
                        $this->pass_data["wiki_description"] = $result_array['suggestions'][0]['plant_details']['wiki_description']['value'];
                        $this->pass_data["wiki_url"] = $result_array['suggestions'][0]['plant_details']['wiki_description']['citation'];
                        $this->pass_data["today"] = $imgDate;
                        $suggestion_array = $result_array['suggestions'][0];

                        if (array_key_exists("wiki_image", $plant_detail_array)) {
                            $this->pass_data["return_img"] = $result_array['suggestions'][0]['plant_details']['wiki_image']['value'];
                        } else if (array_key_exists("similar_images", $suggestion_array) && $suggestion_array['similar_images'] != NULL) {
                            $this->pass_data["return_img"] = $result_array['suggestions'][0]['similar_images'][0]['url'];
                        } else {
                            $this->pass_data["return_img"] = 'data:image/' . $imageFileType . ';base64,' . $imgData;
                        }

                        $this->pass_data["imgSrc"] = 'data:image/' . $imageFileType . ';base64,' . $imgData;
                        $this->data["page_content"] = view("confirm_upload", $this->pass_data);
                        $this->data["topbar"] = view("add_obs_topbar",$this->pass_data);
                        $this->data["page_title"] = "Confirm Observation";

                        return view("mobile_template", $this->data);

                    }
                    else{
                        //Give an alert message if no image is uploaded
                        $this->empty_image_alert["empty_image"]=1;
                        $this->data["page_content"]=view("add_obs_picture",$this->empty_image_alert);
                    }
                }
            else {
                // this part corresponds to wiki page
                $score=$this->request->getVar('score');
                $unique_id=$this->request->getVar('insert_id');
                $update_data=[
                    'score' => $score
                ];
                $model->update($unique_id,$update_data);

                return redirect()->to('activity');
            }

            }


        return view("mobile_template", $this->data);

    }

    public function activity_nearby_map(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->data["navbar"] = view("navbar");
        $this->data["topbar"] = $this->load_topbar();
        $this->data["page_title"] = lang('text.nearby_observation');
        $this->data["page_content"] = view("nearby_map_page");

        $this->data["scripts_to_load"] = array('jquery-3.5.1.js',/*'nearby_map_page.js'*/);

        $db = \Config\Database::connect();
        $outputtype = $this->request->getVar('output');
        if(strcasecmp($outputtype, 'json') == 0){
            $markerBuilder = $db->table('upload');
            $markerBuilder->select('iduser,username,common_name,picture,coordinate,time,scientific_name');
            $markerBuilder->join('users','user_id = iduser');
            $markerQuery = $markerBuilder->get();
            $markers = $markerQuery->getResult();
            return $this->response->setJSON($markers);
        }

        return view("mobile_template",$this->data);
    }


    public function observation_result_test(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->data["navbar"] = view("navbar");
        $this->data["topbar"] = $this->load_topbar();
        $this->data["page_title"] = "Result";
        $this->data["stylesheets_to_load"] = array("obs_result.css");

        $this->pass_data["picture"] = "../../Assets/aloe-vera.jpg";
        $this->pass_data["scientific_name"] = "Aloe Vera";
        $this->pass_data["wiki_url"] = "https://en.wikipedia.org/wiki/Aloe_vera";
        $this->pass_data["wiki_description"] = "Aloe vera (/ˈæloʊiː/ or /ˈæloʊ/) is a succulent plant species of the genus Aloe.[3] An evergreen perennial, it originates from the Arabian Peninsula, but grows wild in tropical, semi-tropical, and arid climates around the world.[3] It is cultivated for agricultural and medicinal uses.[3] The species is also used for decorative purposes and grows successfully indoors as a potted plant.[4]";

        $this->data["page_content"] = view("add_observation_result",$this->pass_data);

        return view("mobile_template",$this->data);
    }

    public function profile_page($id = -1){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        helper('array');
        $db      = \Config\Database::connect();
        $this->data["navbar"] = view("navbar");
        $this->data["stylesheets_to_load"] = array("profile_page.css","slideshow.css");
        $this->data["scripts_to_load"] = array('jquery-3.5.1.js','profile_page.js',"slideshow.js");
        $userModel=new UserModel();
        if($id == -1)
        {
            $this->pass_data["profile_interact_button"] = "edit"; //if someone elses profile, this will be follow
            $this->pass_data["isMyProfile"] = True; //this variable will allow the "follow user" input box to appear when True
            $name_for_this_person = session()->get('username');
            $id_for_this_person = session()->get('id');
            $userResult= $userModel->where('iduser',session()->get("id"))->first();
            $this->pass_data["userbio"] =$userResult['bio'];
            if($userResult['icon'])
            {
                $this->pass_data["profile_picture"]=$userResult['icon'];
            }
            else
                $this->pass_data["profile_picture"] = "/Assets/blank-profile.svg";
        }
        else{
            $id_profile = $id;
            $this->pass_data["isMyProfile"] = False; //this variable will allow the "follow user" input box to appear if True
            $this->pass_data["profile_interact_button"] = "follow"; //if someone elses profile, this will be follow
            $query_text_name ='select username from users where iduser = '.$id_profile;
            $name_for_this_person = dot_array_search('username', $db->query($query_text_name)->getRowArray(0));
            $id_for_this_person = $id_profile;
            $userResult= $userModel->where('iduser',$id_profile)->first();

            if($userResult['bio'])
            {
                $this->pass_data["userbio"] =$userResult['bio'];
            }
            else
                $this->pass_data["userbio"]="Explore beauty of nature";

            if($userResult['icon'])
            {
                $this->pass_data["profile_picture"]=$userResult['icon'];
            }
            else
                $this->pass_data["profile_picture"] = "/Assets/blank-profile.svg";
        }


        $query_text_obNr ='select count(*) as num from upload where user_id = ?';
        $query_text_followingNr = 'select count(*) as num from follow where user_id = ?';
        $query_text_followerNr = 'select count(*) as num from follow where target_id = ?';
        $query_text_distinct_obNr = 'select count(distinct scientific_name) as num from upload where user_id = ?';
        $query_text_task_achieveNr = 'select count(*) as num from achieve where user_id = ?';

        $this->pass_data["username"] = $name_for_this_person;
        $this->pass_data["observation_number"] = dot_array_search('num', $db->query($query_text_obNr,[$id_for_this_person])->getRowArray(0));
        $this->pass_data["following_number"] = dot_array_search('num', $db->query($query_text_followingNr,[$id_for_this_person])->getRowArray(0));
        $this->pass_data["follower_number"] = dot_array_search('num', $db->query($query_text_followerNr,[$id_for_this_person])->getRowArray(0));
        $this->pass_data["distinct_ob_number"] = dot_array_search('num', $db->query($query_text_distinct_obNr,[$id_for_this_person])->getRowArray(0));
        $this->pass_data["task_number"] = dot_array_search('num', $db->query($query_text_task_achieveNr,[$id_for_this_person])->getRowArray(0));
        $followingModel = new followingModel();
        $this->pass_data["followingIds"] = $this->post_data["uploads"] = $followingModel->where('user_id', session()->get("id"))
            ->findAll();
        $this->pass_data["senderId"] = session()->get("id");
        $this->pass_data["targetId"] = $id_for_this_person;


        $this->data["topbar"] = view("profile_topbar", $this->pass_data);
        $this->data["page_content"] = view("profile_page", $this->pass_data);

        if ($this->request->getMethod() == 'post') {
            $model = new UserModel();
            $userID = session()->get('id');
            if(isset($_POST["uploadBioFlag"])) {
                $update_data = [
                    'bio' => $this->request->getVar('profile_bio_textarea')
                ];
                $model->update($userID, $update_data);
                $this->pass_data["userbio"] =$this->request->getVar('profile_bio_textarea');
                $this->data["topbar"] = view("profile_topbar", $this->pass_data);
                $this->data["page_content"] = view("profile_page", $this->pass_data);
                return view("mobile_template",$this->data);
            }
            else if(isset($_POST["uploadIconFlag"]))
            {
                $target_file = basename($_FILES["profilePicture"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $extensions_arr = array("jpg", "jpeg", "png", "img");
                if (in_array($imageFileType, $extensions_arr)) {
                    $imgFile = $_FILES['profilePicture']['tmp_name'];
                    $imgData = base64_encode(file_get_contents($imgFile));
                    $update_data = [
                        'icon' => 'data:image/' . $imageFileType . ';base64,' . $imgData,
                    ];
                    $model->update($userID, $update_data);
                    $this->pass_data["profile_picture"] = 'data:image/' . $imageFileType . ';base64,' . $imgData;
                    $this->data["topbar"] = view("profile_topbar", $this->pass_data);
                    $this->data["page_content"] = view("profile_page", $this->pass_data);
                    return view("mobile_template", $this->data);
                }
            }
        }

        return view("mobile_template",$this->data);
    }

    public function follow(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $mySender = $this->request->getPost("userId");
            $myTarget = $this->request->getPost("targetId");
            $builder = $db->table('follow');
            $data = [
                'user_id' => $mySender,
                'target_id'  => $myTarget,
            ];
            $builder->insert($data);
        }

        return json_encode("success");
    }

    public function unfollow(){
        if($this->request->isAJAX()){
            $db      = \Config\Database::connect();
            $mySender = $this->request->getPost("userId");
            $myTarget = $this->request->getPost("targetId");
            $builder = $db->table('follow');
            $builder->delete(['user_id' => $mySender, 'target_id' => $myTarget]);
        }
        return json_encode("success");
    }

    public function following_list($senderId){
        $db      = \Config\Database::connect();
        $this->data["navbar"] = view("navbar");
        $this->data["topbar"] = view("follow_list_topbar");
        $this->data["page_title"] = lang('text.followingList');
        $this->data["stylesheets_to_load"] = array("users_list.css");


        $this->pass_data["profile_picture"] = "/Assets/blank-profile.svg"; //this needs to be changed by the user's own profile picture

        $sql = "select * from users inner join follow where target_id = iduser having user_id =".$senderId;
        $this->pass_data['users'] = $db->query($sql)->getResultArray();
        $this->data["page_content"] = view("followList",$this->pass_data);
        return view("mobile_template",$this->data);
    }

    public function follower_list($targetId){
        $db      = \Config\Database::connect();
        $this->data["navbar"] = view("navbar");
        $this->data["topbar"] = view("follow_list_topbar");
        $this->data["page_title"] = lang('text.followerList');
        $this->data["stylesheets_to_load"] = array("users_list.css");

        $this->pass_data["profile_picture"] = "/Assets/blank-profile.svg"; //this needs to be changed by the user's own profile picture

        $sql = "select * from users inner join follow where user_id = iduser having target_id =".$targetId;
        $this->pass_data['users'] = $db->query($sql)->getResultArray();
        $this->data["page_content"] = view("followList",$this->pass_data);
        return view("mobile_template",$this->data);
    }

    public function settings(){
        if((session()->get('language'))!=NULL) {
            $this->request->setLocale(session()->get('language'));
        }
        $this->data["navbar"] = view("navbar");
        $this->data["topbar"] = $this->load_topbar();
        $this->data["page_content"]=view("setting");
        $this->data["page_title"] = lang('text.settings');


        if ($this->request->getMethod() == 'post') {
            if(!empty($_POST["en"]))
                session()->set('language','en');
            else if(!empty($_POST["be"]))
                session()->set('language','be');
            else if(!empty($_POST["tk"]))
                session()->set('language','tk');
            else if(!empty($_POST["cn"]))
                session()->set('language','cn');

            return redirect()->to('activity');
        }
        return view("mobile_template",$this->data);
    }

    public function changePassword(){
        if((session()->get('id'))!=NULL) {
            $this->user_data['email']=session()->get('email');
            if ($this->request->getMethod() == 'post') {
                helper(["form"]);
                $rules = [
                    'new_password' => 'required|min_length[8]|max_length[255]',
                    'confirm_new_password' => 'matches[new_password]',
                ];
                if (! $this->validate($rules)) {
                    $this->user_data['validation'] = $this->validator;
                    return view("change_password_page",$this->user_data);
                }
                else{
                    $model=new UserModel();
                    $new_password=$this->request->getVar('confirm_new_password');
                    $userID=session()->get('id');
                    $update_data=[
                        'password' => $new_password
                    ];
                    $model->update($userID,$update_data);

                    return redirect()->to('activity');
                }
            }
            else
            {
                return view("change_password_page",$this->user_data);
            }
        }
    }

    private function load_topbar(){
        $this->pass_data["isLoggedIn"]=session()->get('isLoggedIn');
        return view("topbar",$this->pass_data);
    }
}