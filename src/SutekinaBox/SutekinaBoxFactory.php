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
        $sutekinabox = new SutekinaBox();
        $sutekinabox->setName($request->getName());
        $sutekinabox->setBudget($request->getBudget());
        foreach ($request->getProducts() as $product){
            $sutekinabox->addProduct($product);
        }
        $sutekinabox->setState($request->getState());

        return $sutekinabox;

    }

}