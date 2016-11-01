# biz.jmaconsulting.clicktocall
Click to Call extension for CiviCRM

### Download: Git + Composer (Linux/OS X)

To download the source tree and all dependencies, use [`git`](https://git-scm.com) and [`composer`](https://getcomposer.org/), e.g.:

```
$ git clone https://github.com/JMAConsulting/biz.jmaconsulting.clicktocall.git
$ cd biz.jmaconsulting.clicktocall
$ composer install

```

### Installation

1. As part of your general CiviCRM installation, you should set up a cron job following the [`instructions`](http://wiki.civicrm.org/confluence/display/CRMDOC/Managing+Scheduled+Jobs#ManagingScheduledJobs-Command-lineSyntaxforRunningJobs)
2. As part of your general CiviCRM installation, you should set a CiviCRM Extensions Directory at Administer >> System Settings >> Directories.
3. As part of your general CiviCRM installation, you should set an Extension Resource URL at Administer >> System Settings >> Resource URLs.
4. Create a contact in CiviCRM that will be used to synchronize information following the [`instructions`](http://civicrm.stackexchange.com/questions/9945/how-do-i-set-up-an-api-key-for-a-user/9946#9946)
5. Navigate to Administer >> System Settings >> Manage Extensions.
6. Beside Click to Call using Twilio, click Install.
7. Navigate to Administer >> Communications >> Twilio Settings to add your Twilio Credentials from [`here`](https://www.twilio.com/console)