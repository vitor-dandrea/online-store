<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Product extends Model
{
    /**
     * PRODUCT ATTRIBUTES
     * $this->attributes['id'] - int
     * $this->attributes['name'] - string
     * $this->attributes['description'] - string
     * $this->attributes['image'] - string
     * $this->attibutes['price'] - int
     * $this->attributes['created_at'] - timestamp
     * $this->attributes['updated_at'] - timestamp
     * $this->items - Item[] - contains the associated items
    */

    public static function validate($request)
    {
        $request->validate
        ([
            "name" => "required|max:255",
            "description" => "required",
            "price" => "required|numeric|gt:0",
            'image' => 'image',
        ]);
    }

    /**
     * Forma alternativa de armazenar produtos (usando array associativo no controller)
     * 
     * protected $fillable = [
     * 'name',
     * 'description',
     * 'price',
     * 'image',
     * ];
     * 
     * 
     */

    public static function sumPricesByQuantities($products, $productsInSession)
    {
        $total = 0;
        foreach($products as $product) {
            $total = $total + ($product->getPrice()*$productsInSession[$product->getId()]);
        }

        return $total;
    }


    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id']=$id;
    }

    public function getName()
    {
        return strtoupper($this->attributes['name']);
    }

    public function setName($name)
    {
        $this->attributes['name']=$name;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($description)
    {
        $this->attributes['description']=$description;
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }


    public function setImage($image)
    {
        $this->attributes['image']=$image;
    }

    public function getPrice()
    {
        return $this->attributes['price'];
    }

    public function setPrice($price)
    {
        $this->attributes['price']=$price;
    }

    public function getCreatedAt()
    {
        return $this->attributes["created_at"];
    }

    public function setCreatedAt($created_at)
    {
        $this->attributes['created_at']=$created_at;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updated_at)
    {
        $this->attributes['updated_at']=$updated_at;
    }

    public function items()
    {
        return $this->hasMany(item::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }


}