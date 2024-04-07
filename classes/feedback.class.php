<?php
require_once('database.class.php');
class Feedback extends Database
{
    private $feed_id;
    private $feed_name;
    private $feed_email;
    private $feed_content;
    private $feed_pro_id;

    public function __construct($_feed_id = 0, $_feed_name = '', $_feed_email = '', $_feed_content = '', $_feed_pro_id = 0)
    {
        parent::__construct();
        $this->feed_id = $_feed_id;
        $this->feed_name = $_feed_name;
        $this->feed_email = $_feed_email;
        $this->feed_content = $_feed_content;
        $this->feed_pro_id = $_feed_pro_id;
    }
    public function comment()
    {

        $this->Query('INSERT INTO `feedback`(`feed_name`, `feed_email`, `feed_content`, `feed_pro_id`) VALUES (:feedname,:feedeml,:feedcontent,:feedproid)');
        $this->Bind(':feedname', $this->feed_name);
        $this->Bind(':feedeml', $this->feed_email);
        $this->Bind(':feedcontent', $this->feed_content);
        $this->Bind(':feedproid', $this->feed_pro_id);

        if ($this->Run()) {
            echo "Comment Added";
        } else {
            echo "Comment Not Added";
        }
    }
    public function deleteComment()
    {

        $this->Query('DELETE FROM `feedback` WHERE feedback.feed_id =:feedId');
        $this->Bind(':feedId', $this->feed_id);


        if ($this->Run()) {
            echo "Comment Deleted ";
        } else {
            echo "Comment Not Deleted";
        }
    }
    public function FetchAllComments($product_id)
    {

        $this->Query('select * from feedback where feed_pro_id=:fpid');
        $this->Bind(':fpid', $product_id);
        $allfeedback = $this->All();
        return $allfeedback;
    }
}