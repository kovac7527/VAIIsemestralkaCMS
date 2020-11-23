<?php


class adminUser
{
    private $uid;
    private $username;
    private $passwd;

    public function __construct($username , $passwd , $uid){
        $this->username = $username;
        $this->passwd = $passwd;
        $this->uid = $uid;
    }

    /**
     * @return mixed
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param mixed $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }

    /*** @return mixed */


    public function getPasswd()
    {
        return $this->passwd;
    }
    /**
     * @return mixed
     */

    public function getUsername()
    {
        return $this->username;
    }/**
     * @param mixed $passwd
     */

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    /**
     * @param mixed $username
     */

    public function setUsername($username)
    {
        $this->username = $username;
    }

}