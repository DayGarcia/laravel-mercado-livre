<?php


namespace DayGarcia\LaravelMercadoLivre\Model\Item;

class Item
{
    public function __construct(array $data = null)
    {
        $this->title = $data['title'];
        $this->category_id = $data['category_id'];
        $this->price = $data['price'];
        $this->currency_id = $data['currency_id'];
        $this->available_quantity = $data['available_quantity'];
        $this->buying_mode = $data['buying_mode'];
        $this->condition = $data['condition'];
        $this->listing_type_id = $data['listing_type_id'];
        $this->sale_terms = $data['sale_terms'];
        $this->pictures = $data['pictures'];
        $this->attributes = $data['attributes'];
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle()
    {
        $this->title;
    }


    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    public function getAvailableQuantity()
    {
        return $this->available_quantity;
    }

    public function getBuyingMode()
    {
        return $this->buying_mode;
    }

    public function getCondition()
    {
        return $this->condition;
    }

    public function getListingTypeId()
    {
        return $this->listing_type_id;
    }

    public function getSaleTerms()
    {
        return $this->sale_terms;
    }

    public function getPictures()
    {
        return $this->pictures;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }
}
