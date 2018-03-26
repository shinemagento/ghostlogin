<?php

namespace Shinesoftware\Ghostlogin\Model;

class Login {

    protected $logger;
    protected $customerSession;
    protected $customerRepository;
    protected $customer;
    protected $token;
    protected $pseudoCrypt;

    /**
     * Login constructor.
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Magento\Customer\Model\Customer $customer
     * @param PseudoCrypt $pseudoCrypt
     * @param Token $token
     * @param \Shinesoftware\Licenses\Model\Logger\Shinelogger $logger
     */
    public function __construct(
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\Customer $customer,
        \Shinesoftware\Ghostlogin\Model\PseudoCrypt $pseudoCrypt,
        \Shinesoftware\Ghostlogin\Model\Token $token,
        \Shinesoftware\Licenses\Model\Logger\Shinelogger $logger
    )
    {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->customer = $customer;
        $this->logger = $logger;
        $this->token = $token;
        $this->pseudoCrypt = $pseudoCrypt;
    }

    /**
     * @return string
     */
    public function generateToken(){
        return $this->pseudoCrypt->unhash(rand());
    }

    /**
     * @param $customerId
     */
    public function createToken($customerId, $custompath=null)
    {
        $token = false;
        $hash = $this->generateToken();

        if(!$this->isExist($hash)){
            $token = $this->saveToken($customerId, $hash, $custompath);
        }else{
            $this->createToken($customerId, $custompath);
        }

        return $token;
    }

    /**
     * check if the customer exists
     *
     * @param $customerId
     */
    private function customerExist($customerId){
        try{
            $customer = $this->customerRepository->getById($customerId);
            return true;
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * Save the token
     *
     * @param $customerId
     * @param $token
     * @param null $custompath
     * @return $this
     */
    private function saveToken($customerId, $token, $custompath=null){

        if(!$this->customerExist($customerId)){
            return false;
        }

        $date = date('m/d/Y h:i:s', time());
        try{
            $token = $this->token
                ->setData(array('customer_id' => $customerId,
                                'token' => $token,
                                'status' => 1,
                                'created_at' => $date,
                                'path' => $custompath))
                ->save();
        }catch (\Exception $e){
            $this->logger->addError($e->getMessage());
        }


        return $token;
    }

    private function isExist($token){

        return $this->token->getCollection()
            ->addFieldToFilter('token', $token)
            ->count();
    }

    /**
     * @param string $token
     */
    public function getToken($token)
    {
        $token = $this->token->getCollection()
            ->addFieldToFilter('token', $token)
            ->addFieldToFilter('status', 1)
            ->getFirstItem();
        return $token;
    }

    /**
     * @param string $token
     */
    public function getActiveTokenCollection()
    {
        return $this->token->getCollection()->addFieldToFilter('status', 1);
    }

    /**
     * Set the status of the token as expired
     *
     * @param $token
     * @return bool
     */
    public function setAsExpired($tokenId){
        try{
            $token = $this->token->load($tokenId);
            $token->setStatus(0);
            $token->save();

            return true;

        }catch (\Exception $e){
            $this->logger->addError($e->getMessage());
        }

        return false;

    }

    /**
     * @param $userToken
     * @return bool|\Magento\Framework\DataObject|string
     */
    public function checkToken($userToken)
    {
        $token = $this->getToken($userToken);
        if($token->getData()){
            $this->connect($token->getCustomerId());
            $this->incrementCounter($token->getId());
        }else{
            $this->clearSession();
            return false;
        }

        return $token;
    }

    /**
     * Increment the counter
     *
     * @param $token
     * @return bool
     */
    public function incrementCounter($tokenId){
        try{
            $token = $this->token->load($tokenId);
            $token->setCounter($token->getCounter() + 1);
            $token->save();

            return true;

        }catch (\Exception $e){
            $this->logger->addError($e->getMessage());
        }

        return false;

    }

    /**
     * @param $customerId
     * @return bool
     */
    public function connect($customerId)
    {
        $this->logger->addInfo('Ghost Login has been fired!');
        $customer = $this->customer->load($customerId);
        if($customer){
            $this->clearSession();
            $this->customerSession->setCustomerAsLoggedIn($customer);
            $this->customerSession->regenerateId();
        }else{
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function clearSession()
    {
        $this->customerSession->clearStorage();
        return true;
    }
}