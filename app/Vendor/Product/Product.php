<?php

namespace App\Vendor\Product;

use App\Vendor\Product\Model\Product as DBProduct;


class Product
{
    protected $entity;

    function __construct(DBProduct $product)
    {
        $this->product = $product;
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    public function getParent()
    {
        return $this->entity;
    }

    public function store($product, $key)
    {  

        $product[] = $this->product->updateOrCreate([
                'key' => $key,
                'entity' => $this->entity],[
                'base_price' => $product['baseprice'],
                'total_price' => $product['totalprice'],
                'offer_price' => $product['offerprice'],
                'iva' => $product['iva'],
        ]);
        
        return $product;

    }
    

    public function show($key)
    {
        return DBProduct::getValues($this->entity, $key)->all();   
    }

    public function delete($key)
    {
        if (DBProduct::getValues($this->entity, $key)->count() > 0) {

            DBProduct::getValues($this->entity, $key)->delete();   
        }
    }

}
    

