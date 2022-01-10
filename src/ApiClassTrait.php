<?php

declare(strict_types=1);

namespace i4e\WhmcsApi;

use i4e\WhmcsApi\Api\Authentication;
use i4e\WhmcsApi\Api\Billing;
use i4e\WhmcsApi\Api\Client;
use i4e\WhmcsApi\Api\Custom;
use i4e\WhmcsApi\Api\Domains;
use i4e\WhmcsApi\Api\Orders;
use i4e\WhmcsApi\Api\Servers;
use i4e\WhmcsApi\Api\System;
use i4e\WhmcsApi\Api\Users;

trait ApiClassTrait
{
    public function authentication(): Authentication
    {
        return new Authentication($this);
    }

    public function billing(): Billing
    {
        return new Billing($this);
    }

    public function client(): Client
    {
        return new Client($this);
    }

    public function domains(): Domains
    {
        return new Domains($this);
    }

    public function orders(): Orders
    {
        return new Orders($this);
    }

    public function servers(): Servers
    {
        return new Servers($this);
    }

    public function system(): System
    {
        return new System($this);
    }

    public function users(): Users
    {
        return new Users($this);
    }

    public function custom(): Custom
    {
        return new Custom($this);
    }
}
