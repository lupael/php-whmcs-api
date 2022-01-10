<?php

declare(strict_types=1);

namespace i4e\WhmcsApi\Api;

class System extends AbstractApi
{
    public function whmcsDetails()
    {
        return $this->send('WhmcsDetails');
    }
}
