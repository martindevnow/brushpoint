<?php


namespace Martin\Core\Repositories;


use Martin\Core\Attention;

class AttentionRepo {



    public function getLatestUnseen()
    {
        return Attention::unseen()->latest()->get();
    }

} 