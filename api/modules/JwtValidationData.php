<?php

namespace api\modules;

use yii\helpers\Url;

class JwtValidationData extends \sizeg\jwt\JwtValidationData
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->validationData->setIssuer(Url::base(true));
        $this->validationData->setAudience(Url::base(true));
        $this->validationData->setId('3L3337#(0_0)');

        parent::init();
    }
}
