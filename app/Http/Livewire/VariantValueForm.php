<?php

namespace App\Http\Livewire;

use App\Models\Variant;
use Livewire\Component;
use App\Models\VariantValue;

class VariantValueForm extends Component
{
    public $product;
    public $variants;
    public $variantType;
    public $toBeRemoved;
    public $changed;
    public $addedVariants = [];
    public $addedVariantValues = []; 
    public $newVariantValue;
    public $currentStep = 1;

    protected $rules = [
        'newVariantValue' => 'required|max:128',
    ];
    
    /* *********************
    When the component loads
    mount these 
    ************************
    */    
    public function mount() {
        // Flag to see if admin changed any value
        $this->changed = false;

        //Get all variant types (like size, color) - how they vary
        $this->variants = $this->product->variants;
        $this->variantType = $this->variants->skip($this->currentStep-1)->first()->name;
        
        foreach($this->variants as $type) {
            // Loop through all the variant types
            
            // Get all the variant values for the current variant type 
            // like "red", "blue", "green" in case the variant type is color
            $vv = $type->variantValues;

            // Add all the variant types like size, color etc to a temporary array called "addedVariants"
            // if it is not already added
            $pos = array_search($type->name, array_column($this->addedVariants, 'name'));

            if(!$pos || $pos == 0) {
                array_push($this->addedVariants, ["name" => $type->name, "id" => $type->id]);

                // After adding the variant types to the array
                // Loop through all the variant values of the current variant type
                foreach($vv as $varVal) {
                    
                    // Find if the variant value is already added to another temporary array called "addedVariantValues"
                    $key = array_search($varVal->variant_value, array_column($this->addedVariantValues, 'value'));

                    //If not, add it to the array
                    if(!$key) {
                        array_push($this->addedVariantValues, ["type" => $type->name, "variant_id" => $type->id, "value" => $varVal->variant_value]);
                    }       
                }
            }
        }

        // Now we have an array of all the variant types and their respective variant values
    }


    public function variantValueAdded()
    {
        $variant_id = Variant::where('product_id', '=', $this->product->id)->skip($this->currentStep-1)->first()->id;
        
        // Find if the new variant value entered by the admin is already added to the temporary array called "this->"
        $key = array_search($this->newVariantValue, array_column($this->addedVariantValues, 'value'));
        
        //If not, add it to the array
        if(!$key) {
            array_push($this->addedVariantValues, ["type" => $this->variantType, "variant_id" => $variant_id, "value" => $this->newVariantValue]);
        }       

        // Reset the text field to be blank
        $this->newVariantValue = "";
        $this->changed = true;
    }

    public function proceedToNextStep()
    {
        $variant_id = Variant::where('product_id', '=', $this->product->id)->skip($this->currentStep-1)->first()->id;

        if(!empty($this->newVariantValue)) {
            // Find if the new variant value entered by the admin is already added to the temporary array called "this->"
            $key = array_search($this->newVariantValue, array_column($this->addedVariantValues, 'value'));

            //If not, add it to the array
            if(!$key) {
                array_push($this->addedVariantValues, ["type" => $this->variantType, "variant_id" => $variant_id, "value" => $this->newVariantValue]);
            }       
        }
        // Reset the text field to be blank
        $this->newVariantValue = "";
        $this->currentStep = $this->currentStep+1 <= count($this->variants) ? $this->currentStep + 1 : $this->currentStep;
    }

    public function backToPreviousStep() {
        $variant_id = Variant::where('product_id', '=', $this->product->id)->skip($this->currentStep-1)->first()->id;

        if(!empty($this->newVariantValue)) {
            // Find if the new variant value entered by the admin is already added to the temporary array called "addedVariantValues"
            $key = array_search($this->newVariantValue, array_column($this->addedVariantValues, 'value'));

            //If not, add it to the array
            if(!$key) {
                array_push($this->addedVariantValues, ["type" => $this->variantType, "variant_id" => $variant_id, "value" => $this->newVariantValue]);
            }       
        }

        // Reset the text field to be blank
        $this->newVariantValue = "";
        $this->currentStep = $this->currentStep-1 >= 1 ? $this->currentStep - 1 : 1;
    }

    public function removeVariantValue($vtr)
    {
        $pos = array_search($vtr, array_column($this->addedVariantValues, 'value'));

        if($pos !== false) {
            array_splice($this->addedVariantValues, $pos, 1);
            $this->changed = true;
        }
    }

    public function finishVariantAddition() {
        $data = [];

        // foreach($this->addedVariants as $item) {
        //     VariantValue::where('variant_id', '=', $item['id'])->delete();
        // }


        foreach($this->addedVariantValues as $avv) {
            $existing = VariantValue::where([
                ['variant_id', '=', $avv['variant_id']],
                ['variant_value', '=', $avv['value']],
            ])->get();
            
            if($existing->count() == 0) {

                array_push($data, [
                    "variant_value" => $avv['value'],
                    "variant_id" => $avv['variant_id'],
                ]);
            }
        }

        

        foreach($this->variants as $myvar) {
            //For each variants like size, color
            $myVarVals = $myvar->variantValues;
            
            //Find their corresponding values like red, green, blue for color and 2mm, 4mm for size
            $found = false;

            foreach($myVarVals as $myVarVal) {
                //for each variant value in the database
                $found_pos = in_array($myVarVal['variant_value'], array_column($this->addedVariantValues,"value"));
                
                if(!$found_pos) {

                    $toBeRemoved = VariantValue::findOrFail($myVarVal->id);
                    $toBeRemoved->delete();
                }
            }

        }

        VariantValue::insert($data);

        return redirect(route('products.stock.create', ['id' => $this->product->id]));
    }

    public function updated() {
        $this->variants = $this->product->variants;
        $this->variantType = $this->variants->skip($this->currentStep-1)->first()->name;
    }


    public function render()
    {
        return view('livewire.variant-value-form');
    }

}
