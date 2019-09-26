# Configuration

The high level aim of this configuration is to enable CiviCRM and AWS pinpoint to be able to talk to each other.

This involves some configuration in the AWS console and some configuration in CiviCRM. The CiviCRM configuration is pretty easy. The AWS configuration is more involved. The AWS instructions below are fairly high level. You can find more detailed instructions on how to configure AWS in the AWS documentation. If you get stuck, feel free to ask for help on https://civicrm.stackexchange.com/ or https://chat.civicrm.org/.

We've split the configuration into two parts. Sending SMS and receiving SMS. It makes sense to complete the Sending configuration before starting the receiving configuration.

## Sending SMS

First you need to configure a few things in AWS. You'll then need to copy some credentials from AWS into CiviCRM.

While you are configuring AWS, make a note of the following key bits of information. You'll need them when configuring CiviCRM.

- The AWS region that you are using
- The Project ID of your pinpoint application
- The _key_ and _secret_ of the AWS user that you have granted permission to use AWS Pinpoint

### AWS configuration

First you'll need to create a Pinpoint project and add a phone number to it. You may have to wait for a period of time to be allocated a phone number.

Once you have a phone number allocated, you may want to test it in the AWS configuration UI.

In order to use Pinpoint from CiviCRM, we need to create an AWS user with appropriate permissions.

In AWS IAM (Identity and Access Management), create a new _Group_ and attach an inline policy to the group that allows access to Pinpoint. The following should suffice:

```json
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Action": ["mobiletargeting:*"],
      "Resource": "arn:aws:mobiletargeting:*"
    }
  ]
}
```

Then create a _User_ and add them to the group you just created.

Then create an access key for the user and make a note of the key and the secret.

### CiviCRM configuration

Download and install this extension.

Go to Administer > System Setting > SMS Providers.

Add an AWS pinpoint SMS provider.

In the username and password fields, add your AWS user's key and secret.

In API parameters, you need to enter the AWS region and the application id as follows

```
region=eu-west-1
application_id=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

Some of the other fields in the SMS provider screen are mandatory, but they are are ignored by this extension. Add anything you like to these fields (e.g. 'x').

At this point you should be ready to send an SMS. Try finding a contact with a mobile number and clicking **Actions > Outbound SMS** and sending an SMS.

## Receiving SMS

Once you have set up AWS to send SMS, you can optionally configure it to receive SMS. Setting up AWS to receive SMS involves a few more steps that you might expect, but the process is fairly logical.

At a high level, you configure the phone number to send incoming SMS to an SNS topic. You then create a subscription to the topic so that a CiviCRM 'callback' is notified every time an SMS is received.

First, create an SNS topic as follows: in Pinpoint settings, choose the phone number that you have been allocated and open the Two way SMS configuration section.

Then, in the SNS configuration page (which is separate from Amazon Pinpoint) find the topic you just created, and create a _subscription_ to the topic.

- The subscription protocol should be http or (hopefully) https depending on whether you are using http or https to host your CiviCRM site.
- The end point will vary depending on the domain you are hosting CiviCRM on, and what CMS you use. Here are examples for Drupal and WordPress
  - Drupal: http://www.example.com/civicrm/sms/callback?provider=aws.pinpoint
  - WordPress: https://www.example.org/?page=CiviCRM&q=civicrm%2Fsms%2Fcallback&provider=aws.pinpoint

Once you have created your subscription, it will need to be confirmed. Provided that the extension is enabled in CiviCRM, and a provider is configured, this should happen automatically.

At this point you should be ready to receive an SMS. Try replying to the text that you sent. An inbound SMS activity should be created in CiviCRM.
