<?php
require("../entities.php");
    class BinTest extends \PHPUnit_Framework_TestCase
    {
        public function testReturnsBinId()
        {
            $bin=new Bin(3,2,0,"YES");
            $this->assertEquals(3,$bin->getId());
        }
        public function testReturnsBinLocation()
        {
            $bin=new Bin(3,2,0,"YES");
            $this->assertEquals(2,$bin->getLocation());
        }
        public function testReturnsBinStatus()
        {
            $bin=new Bin(3,2,0,"YES");
            $this->assertEquals(0,$bin->getStatus());
        }
        public function testReturnsBinCleared()
        {
            $bin=new Bin(3,2,0,"YES");
            $this->assertEquals("YES",$bin->getCleared());
        }
        public function testInsertBin()
        {
            $bin=new Bin(3,2,0,"YES");
            $this->assertEquals(1,$bin->insert());
        }
        public function testUpdateBin()
        {
            $bin=new Bin(3,2,0,"NO");
            $this->assertEquals(1,$bin->update());
        }
        public function testDeleteBin()
        {
            $bin=new Bin(3,"Location",0,"YES");
            $this->assertEquals(1,$bin->delete());
        }
        public function testReturnsLocId()
        {
            $loc=new Location(4,"Bantala",22.777,56.6666);
            $this->assertEquals(4,$loc->getId());
        }
        public function testReturnsLocName()
        {
            $loc=new Location(4,"Bantala",22.777,56.6666);
            $this->assertEquals("Bantala",$loc->getName());
        }
        public function testReturnsLocLat()
        {
            $loc=new Location(4,"Bantala",22.777,56.6666);
            $this->assertEquals(22.777,$loc->getLat());
        }
        public function testReturnsLocLng()
        {
            $loc=new Location(4,"Bantala",22.777,56.6666);
            $this->assertEquals(56.6666,$loc->getLng());
        }
        public function testInsertLocation()
        {
            $loc=new Location(4,"Bantala",22.777,56.6666);
            $this->assertEquals(1,$loc->insert());
        }
        public function testDeleteLocation()
        {
            $loc=new Location(4,"Bantala",22.777,56.6666);
            $this->assertEquals(1,$loc->delete());
        }
        public function testMailSetRecipient()
        {
            $mail=new Email();
            $mail->setRecipient("abc@123.com");
            $this->assertEquals("abc@123.com",$mail->recipient);
        }
        public function testMailSetSubject()
        {
            $mail=new Email();
            $mail->setSubject("Important");
            $this->assertEquals("Important",$mail->subject);
        }
        public function testMailSendMail()
        {
            $mail=new Email();
            $mail->setRecipient("abc@123.com");
            $mail->setSubject("Important");
            $this->assertEquals(1,$mail->sendMail("Body of Mail"));
        }
    }
?>