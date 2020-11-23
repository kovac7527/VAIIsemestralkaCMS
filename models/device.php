<?php


class device
{
    private $deviceID;
    private $modelName;
    private $brandId;
    private $series;
    private $image;
    private $description;

    public function __construct( $deviceID,$modelName , $brandId, $series, $image, $description ){
        $this->deviceID = $deviceID;
        $this->modelName = $modelName;
        $this->brandId = $brandId;
        $this->series = $series;
        $this->image = $image;
        $this->description = $description;
    }


    /**
     * @return mixed
     */
    public function getDeviceID()
    {
        return $this->deviceID;
    }
    /**
     * @return mixed
     */
    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $modelName
     */
    public function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    /**
     * @param mixed $brandId
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;
    }

    /**
     * @param mixed $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}