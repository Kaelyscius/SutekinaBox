<?php

namespace App\SutekinaBox;

use App\Entity\SutekinaBox;

class SutekinaBoxRequest {


    private $id;

    private $name;

    private $budget;

    private $products;

    private $creationDate;

    public $state;
    private $product;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
        $this->product = new ArrayCollection();
    }

    /**
     * @param mixed $id
     *
     * @return SutekinaBoxRequest
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return SutekinaBoxRequest
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     *
     * @return SutekinaBoxRequest
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     *
     * @return SutekinaBoxRequest
     */
    public function setProducts($products)
    {

        $this->products = $products;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     *
     * @return SutekinaBoxRequest
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     *
     * @return SutekinaBoxRequest
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Création d'une box depuis une box
     *
     * @param \App\Entity\SutekinaBox $sutekinaBox
     *
     * @return \App\SutekinaBox\SutekinaBoxRequest
     */
    public static function createFromSutekinaBox(SutekinaBox $sutekinaBox) :self
    {
        $sutekinaBoxRequest = new self();
        $sutekinaBoxRequest->name = $sutekinaBox->getName();
        $sutekinaBoxRequest->budget = $sutekinaBox->getBudget();
        $sutekinaBoxRequest->products = $sutekinaBox->getProducts();
        $sutekinaBoxRequest->state = $sutekinaBox->getState();

        return $sutekinaBoxRequest;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     *
     * @return SutekinaBoxRequest
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }


}