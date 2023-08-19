<?php

namespace App\Http\Livewire;

use App\Models\Variant;
use Livewire\Component;

class VariantForm extends Component
{
    public $product;
    public $variantTypesAvailable = ["Size", "Color", "Material"];
    public $addedVariants = [];
    public $newVariant;
    public $variants;
    public $changed;

    public function mount() {
        //status whether something has changed
        $this->changed = false;
        //get all the products existing variants on mount
        $this->variants = $this->product->variants;

        //Loop through each variant - like size, color
        foreach($this->variants as $item) {
            //check whether the variants in the DB are found in array "addedVariants"
            $pos = in_array($item, $this->addedVariants);
            
            //If not, add the existing variants to array 
            if(!$pos) {
                array_push($this->addedVariants, $item->name);
            }
        }
    }

    public function variantSelected($vt)
    {
        //if the new variant selected from dropdown is not already present in the array
        $pos = in_array($vt, $this->addedVariants);

        if(!$pos) {
            //add it to the array
            array_push($this->addedVariants, $vt);
            //Change status of "changed" flag to true
            $this->changed = true;
        }
    }

    public function variantAdded()
    {
        //Get the variant selected in the field and check if found in array
        $pos = in_array($this->newVariant, $this->addedVariants);

        //If not, add the variant to array
        if(!$pos) {
            array_push($this->addedVariants, $this->newVariant);
        }

        //Reset text field to blank, reset flag to changed.
        $this->newVariant = "";
        $this->changed = true;
    }

    public function removeVariant($vt)
    {
        //If the user is removing a variant, check the position of the variant in array
        $pos = array_search($vt, $this->addedVariants);
        //Remove the element from array
        array_splice($this->addedVariants, $pos, 1);
        //Status flag changed
        $this->changed = true;
    }

    public function addVariantsToProduct()
    {
        //Create an empty array
        $data = [];
        $i = 0;

        //Variant::where('product_id', '=', $this->product->id)->delete();

        foreach($this->addedVariants as $item) {
            //Loop through items in the array

            //Find if the product already has that variant
            $duplicate = Variant::where([
                ['product_id', '=', $this->product->id],
                ['name', '=', $item]
            ])->first();

            if($duplicate==NULL) {

                //if not push it to the array
                $i++;

                array_push($data, [
                    "name" => $item,
                    "product_id" => $this->product->id,
                    "sort_order" => $i,
                ]);
                
            } 

        }

        foreach($this->variants as $myvariant) {
            $found = false;
            if(in_array($myvariant->name, $this->addedVariants)) {
                $found = true;
            } else {
                Variant::findOrFail($myvariant['id'])->delete();
            }
        }

        Variant::insert($data);
        return redirect(route('products.variants.create', ['id' => $this->product->id]));
    }

    public function gotoNextStep() {
        return redirect(route('products.variants.create', ['id' => $this->product->id]));
    }

    public function updated() {
        $this->variants = $this->product->variants;
    }

    public function render()
    {
        return view('livewire.variant-form');
    }

    
}
