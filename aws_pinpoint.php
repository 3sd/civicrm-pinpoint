<?php


/**
 * Class CRM_SMS_Provider_Dummysms
 */
class aws_pinpoint extends CRM_SMS_Provider
{

    protected $params = array();


    static private $_singleton;

    function __construct($provider)
    {
        $this->params = civicrm_api3('SmsProvider', 'getsingle', ['id' => $provider['provider_id']]);
    }

    static function singleton($provider, $force)
    {
        if (!isset(self::$_singleton)) {
            self::$_singleton = new aws_pinpoint($provider);
        }
        return self::$_singleton;
    }

    function send($recipients, $header, $message, $jobID = NULL, $userID = NULL)
    {
        
        return // (the ID from AWS pinpoint);
        return PEAR::raiseError('message', 'code', PEAR_ERROR_RETURN);
    }

    function inbound($from_number, $content, $id = NULL)
    {
        return parent::processInbound($from_number, $content, NULL, $id);
    }
}
