<?php
    class Location
    {
        public $locid;
        public $name;
        public $latitude;
        public $longitude;
        function __construct($id,$n,$lat,$lng)
        {
            $this->locid=$id;
            $this->name="$n";
            $this->latitude=$lat;
            $this->longitude=$lng;
        }
        function getId(){ return $this->locid; }
        function getName(){ return $this->name; }
        function getLat(){ return $this->latitude; }
        function getLng(){ return $this->longitude; }
        function insert()
        {
            $id=$this->locid;
            $name=$this->name;
            $lat=$this->latitude;
            $lng=$this->longitude;
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"smartbin")or die(mysqli_error($link));
            $ins="INSERT INTO location VALUES($id,'$name',$lat,$lng)";
            $err=mysqli_query($link,$ins)or die(mysqli_error($link));
            return $err;
        }
        function delete()
        {
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"smartbin")or die(mysqli_error($link));
            $id=$this->locid;
            $del="DELETE FROM location WHERE locid=$id";
            $err=mysqli_query($link,$del)or die(mysqli_error($link));
            return $err;
        }
    }
    class Bin{
        public $id;
        public $status;
        public $location;
        public $cleared;
        function __construct($ID,$loc,$stat,$clr)
        {
            $this->id=$ID;
            $this->location=$loc;
            $this->status=$stat;
            $this->cleared=$clr;
        }
        function insert()
        {
            $id=$this->id;
            $locid=$this->location;
            $stat=$this->status;
            $clr=$this->cleared;
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"smartbin")or die(mysqli_error($link));
            $ins="INSERT INTO bin VALUES($id,$locid,$stat,'$clr')";
            $err=mysqli_query($link,$ins)or die(mysqli_error($link));
            return $err;
        }
        function update()
        {
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"smartbin")or die(mysqli_error($link));
            $up="UPDATE bin SET status=$this->status,cleared='$this->cleared' WHERE bid=$this->id";
            $err=mysqli_query($link,$up)or die(mysqli_error($link));
            return $err;
        }
        function delete()
        {
            $link=mysqli_connect("localhost","root","");
            mysqli_select_db($link,"smartbin")or die(mysqli_error($link));
            $id=$this->id;
            $del="DELETE FROM bin WHERE bid=$id";
            $err=mysqli_query($link,$del)or die(mysqli_error($link));
            return $err;
        }
        function getId(){
            return $this->id;
        }
        function getLocation(){
            return $this->location;
        }
        function getStatus(){
            return $this->status;
        }
        function getCleared(){
            return $this->cleared;
        }
    }
    class Email{
        public $recipient;
        public $subject;
        public $body;
        function setRecipient($email)
        {
            $this->recipient=$email;
        }
        function setSubject($sub)
        {
            $this->subject=$sub;
        }
        function sendMail($content,$headers)
        {
            return mail($this->recipient,$this->subject,$content,$headers);
        }
    }
?>