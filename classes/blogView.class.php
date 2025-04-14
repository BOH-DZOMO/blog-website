<?php
class blogView extends blogModel
{
    public function output_topics()
    {
        $data = $this->get_topics();
        echo "<option selected>Select a topic</option>";
        foreach ($data as $item) {
            echo "<option value='{$item['topicid']}'>{$item['name']}</option>";
        }
    }
    public function output_topicsEdit($data){
        $topics = $this->get_topics();
        foreach ($topics as $item) {
            if ($item["name"] == $data) {
                echo "<option value='{$item['topicid']}' selected>{$item['name']}</option>";
            }
            else{
                echo "<option value='{$item['topicid']}'>{$item['name']}</option>";
            }
        }
    }
    public function output_blogs()
    {
        $dataset = $this->get_blogs();
        foreach ($dataset as $data) {
            $image_destination = str_replace("../", "", "{$data['image_path']}");
            echo "
            <section class='blog-post'>
                   <figure>
                       <img src='$image_destination' alt='image' style='width:100%'>
                       <figcaption>{$data['name']}</figcaption>
                   </figure>
                   <div class='blog-body'>
                       <h3><a href='blog-page.php?post={$data["postid"]}'>{$data['title']}</a></h3>
                       <p class='preview'>'preview</p>
                       <p><span>{$data['username']}</span> - <span>{$data['last_updated']}</span></p>
                   </div>
               </section>
       ";
        }
    }
    public function output_fullblog($postid)
    {
        // if (isset($_GET["post"])) {
            $data = $this->get_fullblog($postid);
            $image_destination = str_replace("../", "", "{$data['image_path']}");
            echo "
        <div class=''>
            <span>{$data['name']}</span>
            <span>{$data['last_updated']}</span>
            <span>{$data['username']}</span>
        </div>
        <div>
            <h2>{$data['title']}</h2>
        </div>
        <div>
            <div class='image_holder mb-3'>
                <img src='$image_destination' alt='' class='cover-image'>
            </div>
            <p class='blog-body'>{$data['content']}</p>
        </div>
        ";
        // } else {
        //     echo "<p>The blog was not found...., Try again and make sure you are logined</p>";
        // }
    }
    public function output_editForm($postid){
        $data = $this->get_fullblogEdit($postid);
        $image_destination = str_replace("../", "", "{$data['image_path']}");
        
        echo "<div class='blog-content'>
 <form action='includes/blog.inc.php' method='post' enctype='multipart/form-data'>
        <div class='d-flex justify-content-center' style='width: 100%;'>
            <img class='img-fluid' src='{$image_destination}' id='image' alt='image' width='120px' height='100px'>
        </div>  
     <div class='mb-3'>
         <label for='title' class='form-label'>Title</label>
         <input class='form-control form-control-lg' type='text' placeholder='.form-control-lg' aria-label='title' value ='{$data['title']}' name='title_edit'>
     </div>
     <div class='mb-3'>
         <label for='body' class='form-label'>Body</label>
         <textarea class='form-control' id='body' rows='5' value ='' name='body_edit'>{$data['content']}</textarea>
     </div>
     <div class='mb-3'>
         <label for='topic' class='form-label'>Topic</label>";

    echo "<select class='form-select form-select-lg' aria-label='topic' name='topic_edit'>";

        $this->output_topicsEdit($data['name']);
    echo "
         </select>
     </div>
     <div class='mb-3'>
         <label for='cover-image' class='form-label'>Choose new Image</label>
         <input class='form-control' type='file' id='cover-image' name='cover-image_edit'  accept='.jpg, .jpeg, .png, .gif'>
         
     </div>
     <button type='submit' class='btn btn-success' name='modify'>Modify</button>
 </form>
</div>";

    } 
    static public function find_userid($postid){
        return blogModel::get_Authorid($postid);
    }
}