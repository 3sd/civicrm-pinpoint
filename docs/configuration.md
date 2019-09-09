# Configuration

At a high level you will need to

- Do some configuration at AWS
- Do some configuration in CiviCRM
- Set up AWS and CiviCRM to communicate with each other.

## AWS configuration

You'll need to create a Pinpoint project and add a phone number to it.

1. Sign up for an AWS pinpoint account
2. Create a new Pinpoint project
3. Sign up for a phone number to use with your pinpoint account

Once you have a phone number, you can test it \*\*\*

To receive SMS, you'll need to create an SNS _topic_ and create a _subscription_ to the topic that notifies CiviCRM when an SMS is received.

1. Configure two way SMS for your numberGo to Settings > SMS and voice

## CiviCRM configuration

## Sending an SMS

CiviCRM tell Pinpoint to send an SMS

## Receiving an SMS

Pinpoint tells CiviCRM is has received an an SMS.
