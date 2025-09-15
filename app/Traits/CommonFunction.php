<?php

namespace App\Traits;

use App\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

trait CommonFunction
{
    public function createUserName($string)
    {
        $pattern = " ";
        $firstPart = strstr(strtolower($string), $pattern, true);
        $secondPart = substr(strstr(strtolower($string), $pattern, false), 0, 3);
        $nrRand = rand(0, 100);

        $username = trim($firstPart) . trim($secondPart) . trim($nrRand);
        return $username;
    }

    public function categoryDropdownOptions($categories, $selectedId = null, $parentId = null, $prefix = '')
    {
        $options = '';
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $is_select = '';
                if ($category->id == $selectedId) {
                    $is_select = 'selected';
                }
                $options .= '<option value="' . $category->id . '" ' . $is_select . '>' . $prefix . $category->title . '</option>';
                $options .= $this->categoryDropdownOptions($categories, $selectedId, $category->id, $prefix . '↳');
            }
        }
        return $options;
    }

    public function getTopParent($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category->parent_id === null) {
            return $category->id;
        } else {
            return $this->getTopParent($category->parent_id);
        }
    }

    public function getAllAttributesCombination($productId)
    {
        $returnArray = array();
        $attributeValue = array();
        $product = Product::find($productId);
        $attributes = $product?->parentCategory?->attribute;
        $attributeName = $attributes->pluck('name')->toArray();
        $attributeId = $attributes->pluck('id')->toArray();
        foreach ($attributes as $key => $attribute) {
            $attributeValue[$key] = $attribute->values->pluck('value')->toArray();
        }
        $returnArray['attribute_id'] = $attributeId;
        $returnArray['attribute_name'] = $attributeName;
        $returnArray['attributes'] = array_combine($attributeId, $attributeName);
        $returnArray['combinations'] = $this->generateAllCombinations($attributeValue);
        return $returnArray;
    }
    public function generateAllCombinations($lists, $result = [], $depth = 0, $current = [])
    {
        if ($depth == count($lists)) {
            $result[] = $current;
            return $result;
        }
        foreach ($lists[$depth] as $element) {
            $newCurrent = $current;
            $newCurrent[] = $element;
            $result = $this->generateAllCombinations($lists, $result, $depth + 1, $newCurrent);
        }
        return $result;
    }


    public function verifyOTP($otp){
         $user = User::where('id', auth()->user()->id)
                    ->first();
        $check_time = \Carbon\Carbon::parse($user->form_validation_otp_time)->addMinute(30);
        if ($user && $user->form_validation_otp_time && $check_time->isPast()) {
           $data =  ['status' => false, 'message' => 'OTP has expired. Please request a new OTP', 'data' => null];
            //  $data = ['status' => false, 'message' => 'qsqsqsqsqswqww', 'data' => null];
                    return $data;
        }

        if ($user && $user->form_validation_no_of_attempted <= 0) {
           $data =  ['status' => false, 'message' => 'You’ve exceeded the allowed attempts. The OTP is expired. Please request a new one to continue.', 'data' => null];
            //  $data = ['status' => false, 'message' => 'qsqsqsqsqswqww', 'data' => null];
                    return $data;
        }

        if($user && $user->form_validation_otp == $otp){
            $data = ['status' => true];
               return $data;
        }else{
            $user->update(['form_validation_no_of_attempted'=>($user->form_validation_no_of_attempted - 1)]);
           $data =  ['status' => false, 'message' => 'Your OTP is not valid', 'data' => null];
            //  $data = ['status' => false, 'message' => 'qsqsqsqsqswqww', 'data' => null];
                    return $data;
        }
    }
}
