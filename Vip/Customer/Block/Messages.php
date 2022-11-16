<?php
namespace Vip\Customer\Block;

class Messages extends \Magento\Framework\View\Element\Template

{
     protected $helper;
     protected $groupRepository;
   
     public function __construct(        
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Api\GroupRepositoryInterface $groupRepository,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,    
        array $data = [] ) 
     {    
        $this->scopeConfig = $scopeConfig;
        $this->groupRepository = $groupRepository;
        parent::__construct($context, $data);
     }
  
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
    }

    public function getCustomerReview(){   
       
       
      $value ='';

      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $customerSession = $objectManager->get('Magento\Customer\Model\Session');
            if($customerSession->isLoggedIn()) {
                $id = $customerSession->getCustomer()->getGroupId();
                $groupEntity = $this->groupRepository->getById($id);
                $groupname =  $groupEntity->getCode();
               
                if($groupname=='General'){
                    // if user is genral customer then that condition run 

                    $msg = $this->scopeConfig->getValue('extension/general/gen_cust', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
                    $value ='Massage  :- ' .$msg;
                }
                else if($groupname=='Retailer'){
                    //if user is reteller then that condition will be run
                    $msg = $this->scopeConfig->getValue('extension/general/rete_cust', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
                    $value ='Massage :- ' .$msg;
                }
                else if($groupname=='Wholesale'){
                    //if user is wholesaler then that condition will be run
                    $msg = $this->scopeConfig->getValue('extension/general/whol_cust', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
                    $value ='Massage :- ' .$msg;
                }
                else if($groupname=='VIP Customers'){
                    //if user is vip customer then the condition will be run
                    $msg = $this->scopeConfig->getValue('extension/general/vip_cust', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
                    $value ='Massage :- ' .$msg;

                }

            }

            else{
                // this condition is for when user is guest then that condition will be run 
                $value = $this->scopeConfig->getValue('extension/general/gen_cust', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
          

            }

	
        return  "  ". $value;

    }

}