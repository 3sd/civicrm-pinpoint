<?php


/**
 * Class CRM_SMS_Provider_Dummysms
 */
class aws_pinpoint extends CRM_SMS_Provider
{

  protected $config = array();

  /**
   * A processed params array
   *
   * @var array
   */
  protected $params = array();


  static private $_singleton;

  function __construct($provider)
  {
    $this->config = civicrm_api3('SmsProvider', 'getsingle', ['id' => $provider['provider_id']]);
    $params = explode("\n", $this->config['api_params']);
    foreach ($params as $line) {
      $parts = explode('=', trim($line));
      $key = array_shift($parts);
      $this->params[$key] = implode('=', $parts);
    }
  }

  static function &singleton($providerParams = [], $force = false)
  {
    if (!isset(self::$_singleton)) {
      self::$_singleton = new aws_pinpoint($providerParams);
    }
    return self::$_singleton;
  }

  function send($recipients, $header, $message, $jobID = NULL, $userID = NULL)
  {

    $client = new Aws\Pinpoint\PinpointClient([
      'version' => 'latest',
      'region'  => $this->params['region'],
      'credentials' => [
        'key'    => $this->params['key'],
        'secret' => $this->params['secret'],
      ]
    ]);

    $result = $client->sendMessages([
      'ApplicationId' => $this->params['application_id'],
      'MessageRequest' => [
        'Addresses' => [
          $recipients => [
            'ChannelType' => 'SMS',
          ],
        ],
        'MessageConfiguration' => [
          'SMSMessage' => [
            'Body' => $message,
          ],
        ],
      ],
    ]);

    return $result->get('MessageResponse')['RequestId'];
  }

  function inbound($from_number, $content, $id = NULL)
  {
    return parent::processInbound($from_number, $content, NULL, $id);
  }
}
