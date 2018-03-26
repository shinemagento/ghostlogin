<?php


namespace Shinesoftware\Ghostlogin\Cron;

class Checklinks
{
    const STATUS_ACTIVE = 1;
    const IS_ACTIVE = 'ghostlogin/settings/active';
    const EXPIREDAYS = 'ghostlogin/settings/expire';

    protected $scopeConfig;
    protected $storeManager;
    protected $logger;
    protected $token;
    protected $timezone;
    protected $tokenModelFactory;

    /**
     * CheckLinks constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Shinesoftware\Ghostlogin\Model\TokenFactory $tokenFactory
     * @param \Shinesoftware\Ghostlogin\Model\Logger\Shinelogger $logger
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Shinesoftware\Ghostlogin\Model\Login $token,
        \Shinesoftware\Ghostlogin\Model\Logger\Shinelogger $logger,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->token = $token;
        $this->timezone = $timezone;

    }

    /**
     * Execute the cron
     *
     * @return void
     */
    public function execute()
    {

        $tokens = $this->token->getActiveTokenCollection();
        $days = $this->scopeConfig->getValue ('ghostlogin/settings/expire', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($days <= 0){
            return true;
        }

        if($tokens->count()){
            foreach ($tokens as $token){
                $expire = strtotime($token->getCreatedAt() . " + $days days" );
                $today = strtotime("today midnight");

                if($today >= $expire){
                    $this->logger->addInfo('This link is expired ' . $token->getId() . ' - ' . $token->getCreatedAt() . ' - ' . $token->getToken());
                    $this->token->setAsExpired($token->getId());
                }
            }
        }
    }


}
