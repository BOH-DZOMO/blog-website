<?php
class blogModel extends Dbh
{

    protected function get_topics()
    {
        $query = "SELECT topicid, name FROM topics";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function set_post(int $userid, int $topicid, string $title, string $content)
    {
        $query = "INSERT INTO `posts`(`userid`,`topicid`, `title`, `content`) VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($userid, $topicid, $title, $content));
        // $this->connect()->lastInsertId();
    }
    protected function edit_post(int $topicid, string $title, string $content, int $postid)
    {
        $query = "UPDATE `posts` SET `topicid`= ?,`title`= ?,`content`= ? WHERE postid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($topicid, $title, $content, $postid));
    }
    protected function get_postid()
    {
        $query = "SELECT postid FROM posts ORDER BY postid DESC LIMIT 1";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
        $stmt = null;
    }
    protected function set_coverImage(int $id, string $destination)
    {
        $query = "INSERT INTO `post_images`( `postid`, `image_path`) VALUES (?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($id, $destination));
        $stmt = null;
    }

    protected function edit_coverImage(string $destination, int $imageid)
    {
        $query = "UPDATE `post_images` SET `image_path`=? WHERE imageid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($destination, $imageid));
        $stmt = null;
    }
    public function get_blogs()
    {
        $query = "SELECT posts.postid,posts.title,posts.last_updated,posts.created,users.username,post_images.image_path,topics.name
        FROM (((posts
        INNER JOIN users ON posts.userid = users.id)
        INNER JOIN post_images ON posts.postid = post_images.postid)
        INNER JOIN topics ON topics.topicid = posts.topicid)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    protected function get_fullblog($postid)
    {
        $query = "SELECT posts.postid,posts.title,posts.last_updated,posts.content,posts.created,users.username,post_images.image_path,topics.name
        FROM (((posts
        INNER JOIN users ON posts.userid = users.id)
        INNER JOIN post_images ON posts.postid = post_images.postid)
        INNER JOIN topics ON topics.topicid = posts.topicid) WHERE posts.postid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($postid));
        $result = $stmt->fetch();
        return $result;
    }
    protected function get_fullblogEdit($postid)
    {
        $query = "SELECT posts.title,posts.content,post_images.image_path,post_images.imageid,topics.name,topics.topicid
        FROM ((posts
        INNER JOIN post_images ON posts.postid = post_images.postid)
        INNER JOIN topics ON topics.topicid = posts.topicid) WHERE posts.postid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($postid));
        $result = $stmt->fetch();
        return $result;
    }
    protected function del_image($imageid)
    {
        $query = "DELETE FROM `post_images` WHERE imageid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($imageid));
        $stmt = null;
    }
    protected function del_post($postid)
    {
        $query = "DELETE FROM `posts` WHERE posts.postid = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($postid));
        $stmt = null;
    }
    protected function del_blog($imageid, $postid)
    {
        try {
            $this->connect()->beginTransaction();
            $query = "SELECT `image_path` FROM `post_images` WHERE imageid = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($imageid));
            $image_path = $stmt->fetch(PDO::FETCH_COLUMN);

            $query = "DELETE FROM `post_images` WHERE imageid = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($imageid));

            $query = "DELETE FROM `posts` WHERE posts.postid = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute(array($postid));

            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->connect()->commit();


        } catch (PDOException $e) {
            // $this->connect()->rollBack();
            echo "Error: ". $e->getMessage();
        }
    }
    protected function get_imageid($postid, $image_path)
    {
        $query = "SELECT `imageid` FROM `post_images` WHERE postid = ? AND image_path LIKE ?";
        $stmt = $this->connect()->prepare($query);
        $image_path_like = '%' . $image_path . '%';
        $stmt->execute(array($postid, $image_path_like));
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    static protected function get_Authorid($postid)

    {
        try {
            $dsn = "mysql:host=localhost;dbname=blog_application";
            $pdo = new PDO($dsn, "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $query = "SELECT userid FROM posts WHERE posts.postid = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($postid));
            return $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            
            echo $e->getCode() . "<br>";
            echo $e->getMessage() . "<br>";
            die();
        }
    }
    protected function set_subscriber($username,$email){
        $query = "INSERT INTO `subscriptions`( `email`, `name`) VALUES (?,?)";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array($email,$username));
        $stmt = null;
    }
    protected function get_subscriber(){
        $query = "SELECT `email`,`name` FROM `subscriptions`";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute(array());
        return $stmt->fetchAll();
    }
}
