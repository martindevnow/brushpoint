<?php


namespace Martin\Core\Repositories;


use Martin\Core\Attention;

class AttentionRepo {



    public function getLatestUnseen($howMany = 10)
    {
        return Attention::unseen()->latest()->paginate($howMany);
    }

} 