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
        $selectedProduct = [];
        $sutekinabox = new SutekinaBox();
        $sutekinabox->setName($request->getName());
        $sutekinabox->setBudget($request->getBudget());
        foreach ($request->getProducts() as $key => $product){

            if ($product->getIsSelected() === true){
                $selectedProduct[] = $product;
            }
        }
        dd($selectedProduct);

        $sutekinabox->setProducts($selectedProduct);
        $sutekinabox->setState($request->getState());

        return $sutekinabox;

    }

}