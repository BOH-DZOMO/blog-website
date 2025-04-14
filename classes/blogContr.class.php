<?php
class blogContr extends blogModel
{

    private $title;
    private $body;
    private $topic;
    private $cover_image;
    private $userid;
    private $error_logs = [];
    private $edit_error_logs = [];
    private $postid;
    private $imageid;

    public function __construct($title = null, $body = null, $topic = null, $cover_image = null, $userid = null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->topic = $topic;
        $this->cover_image = $cover_image;
        $this->userid = $userid;    //*** */

    }
    public function publishBlog()
    {
        $image_destination = "";
        if ($this->emptyInput()) {
            $this->error_logs["empty_input"] = "Fill in all fields!";
            $_SESSION["errors_logs"] = $this->error_logs;
            $this->error_logs = [];
            header("location: ../index.php");
            exit();
        }
        $this->set_post($this->validate($this->userid), $this->validate($this->topic), $this->validate($this->title), $this->validate($this->body));
        $postid = $this->get_postid();
        // verrifying that image is well loaded and some processing before sending to db
        if (isset($this->cover_image) && $this->cover_image['error'] === UPLOAD_ERR_OK) {        
            $image_name = $this->cover_image['name'];
            $image_type = $this->cover_image['type'];
            $image_size = $this->cover_image['size'];
            $image_tmp = $this->cover_image['tmp_name'];
            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            $upload_dir = '../uploads/';
            $max_allowed_size = 2000000;
            //extract info image name
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            if (in_array($image_type, $allowed_types)) {
                if ($image_size <= $max_allowed_size) {
                    $temp_image_name = "cid_$postid.$file_extension";
                    $image_destination = $upload_dir . $temp_image_name;
                    move_uploaded_file($image_tmp, $image_destination);
                } else {
                    $this->error_logs["image_size"] = ["Maximaum Image size exceeded"];
                }
            } else {
                $this->error_logs["invalid_image_type"] = ["Invalid image type used,allowed types are:('JPG', 'JPEG', 'PNG', 'GIF')"];
            }
        } else {
            $this->error_logs["image_error"] = ["Error occured in uploading image."];
        }

        if ($this->error_logs) {
            $_SESSION["errors_logs"] = $this->error_logs;
            $this->error_logs = [];
            header("location: ../index.php");
            exit();
        }
        $this->set_coverImage($postid, $image_destination);
        header("location: ../index.php?post=success");
        exit();

    }
    public function editBlog(){
        $image_destination = "";
        if ($this->edit_emptyInput()) {
            $this->edit_error_logs["empty_input"] = "Fill in all fields!";
            $_SESSION["edit_errors_logs"] = $this->edit_error_logs;
            $this->edit_error_logs = [];
            header("location: ../index.php?view=1");
            exit();
        }
        elseif ( $this->isDiff($this->postid) == false) {
            $this->edit_error_logs["same_input"] = "No changes were made!";
            $_SESSION["edit_errors_logs"] = $this->edit_error_logs;
            $this->edit_error_logs = [];
            header("location: ../index.php?view=2");
            exit();
        }
        $this->edit_post($this->validate($this->topic), $this->validate($this->title), $this->validate($this->body),$this->postid);
        // verrifying that image is well loaded and some processing before sending to db
        if (empty($this->cover_image['name']) == false) {
            if (isset($this->cover_image) && $this->cover_image['error'] === UPLOAD_ERR_OK) {        
                $image_name = $this->cover_image['name'];
                $image_type = $this->cover_image['type'];
                $image_size = $this->cover_image['size'];
                $image_tmp = $this->cover_image['tmp_name'];
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
                $upload_dir = '../uploads/';
                $max_allowed_size = 2000000;
                //extract info image name
                $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                if (in_array($image_type, $allowed_types)) {
                    if ($image_size <= $max_allowed_size) {
                        $temp_image_name = "cid_$this->postid.$file_extension";
                        $image_destination = $upload_dir . $temp_image_name;
                        move_uploaded_file($image_tmp, $image_destination);
                    } else {
                        $this->edit_error_logs["image_size"] = ["Maximaum Image size exceeded"];
                    }
                } else {
                    $this->edit_error_logs["invalid_image_type"] = ["Invalid image type used,allowed types are:('JPG', 'JPEG', 'PNG', 'GIF')"];
                }
            } else {
                $this->edit_error_logs["image_error"] = ["Error occured in uploading image."];
            }
        }
        
        if ($this->edit_error_logs) {
            $_SESSION["edit_errors_logs"] = $this->edit_error_logs;
            $this->edit_error_logs = [];
            header("location: ../index.php?view=3");
            exit();
        }
        if (empty($this->cover_image['name']) == false) {
            $this->edit_coverImage($image_destination, $this->imageid);
        }
        
        header("location: ../index.php?edit=success");
        exit();

    }


    private function emptyInput()
    {
        if (empty($this->title) || empty($this->body) || empty($this->topic) || empty($this->cover_image['name'])) {
            return true;
        } else {
            return false;
        }
    }
    private function edit_emptyInput()
    {
        if (empty($this->title) || empty($this->body) || empty($this->topic)) {
            return true;
        } else {
            return false;
        }
    }
    private function validate($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    private function isDiff($postid){
        $data = $this->get_fullblogEdit($postid);
        $this->imageid = $data["imageid"];
        if ($this->title === $data['title'] && $this->body === $data['content'] && $this->topic === $data['topicid'] && empty($this->cover_image['name'])) {
            return false;
        }
        else{
            return true;
        }
    }
    public function delete_blog(){
        $this->find_imageid();
        // $this->del_image($this->imageid);
        // $this->del_post($this->postid);
        $this->del_blog($this->imageid, $this->postid);
        header("location: ../index.php?delete=success");
        exit();

    }
    public function set_postid($postid){
        $this->postid = $postid;
    }
    public function find_imageid(){
        $image_path = "../uploads/cid_{$this->postid}";
        $this->imageid =  $this->get_imageid($this->postid, $image_path);
    }
    public function subscribe($username,$email){
        $this->set_subscriber($username,$email);
    }
    

}
