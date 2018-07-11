<?php

namespace App\SutekinaBox;


use App\Entity\SutekinaBox;

class SutekinaBoxFactory
{

    /**
     * @param \App\SutekinaBox\SutekinaBoxRequest $request
     *
     *
     * @return \App\Entity\SutekinaBox
     */
    public function createFromSutekinaBoxRequest(SutekinaBoxRequest $request): SutekinaBox
    {
        dd($request);
        $selectedProduct = [];
        $sutekinabox = new SutekinaBox();
        $sutekinabox->setName($request->getName());
        $sutekinabox->setBudget($request->getBudget());
        foreach ($request->getProducts() as $product){
            if ($product->getIsSelected()){
                $selectedProduct[] = $product;
            }
        }
        $sutekinabox->setProducts($selectedProduct);
        $sutekinabox->setState($workflow);

        return $sutekinabox;

    }

}