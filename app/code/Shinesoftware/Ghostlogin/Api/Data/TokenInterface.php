<?php


namespace Shinesoftware\Ghostlogin\Api\Data;

interface TokenInterface
{

    const ID = 'id';
    const TOKEN = 'token';
    const CUSTOMER_ID = 'customer_id';
    const PATH = 'path';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const COUNTER = 'counter';

    /**
     * Get id
     * @return integer|null
     */

    public function getId();

    /**
     * Set id
     * @param string $id
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setId($id);

    /**
     * Get token
     * @return string|null
     */

    public function getToken();

    /**
     * Set id
     * @param string $token
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setToken($token);

    /**
     * Get created date
     * @return string|null
     */

    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $token
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setCreatedAt($created_at);


    /**
     * Get path
     * @return string|null
     */

    public function getPath();

    /**
     * Set path
     * @param string $path
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setPath($path);


    /**
     * Get status of the token
     * @return string|null
     */

    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setStatus($status);


    /**
     * Get customer id
     * @return string|null
     */

    public function getCustomerId();

    /**
     * Set customer Id
     * @param string $customer_id
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setCustomerId($customer_id);


    /**
     * Get counter
     * @return integer|null
     */

    public function getCounter();

    /**
     * Set counter
     * @param integer $counter
     * @return \Shinesoftware\Ghostlogin\Api\Data\TokenInterface
     */

    public function setCounter($counter);


}
