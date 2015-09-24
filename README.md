[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Wabel/threads-io-php-plug/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Wabel/threads-io-php-plug/?branch=1.0)
[![Build Status](https://travis-ci.org/Wabel/threads-io-php-plug.svg?branch=master)](https://travis-ci.org/Wabel/threads-io-php-plug)
[![Coverage Status](https://coveralls.io/repos/Wabel/threads-io-php-plug/badge.svg?branch=master&service=github)](https://coveralls.io/github/Wabel/threads-io-php-plug?branch=master)

Wabel's Threads.io PHP plug
===========================

What is this?
-------------

This project is a PHP connector to [Threads.io](http://threads.io). Use this plug to identify your users, track events and page visits or remove them from your Threads.io account.

Initialize
----------

Here is a basic example on how you can use Wabel's Threads.io PHP Plug :

```php
use \Wabel\ThreadsIo\ThreadsIoClient;
use \Wabel\ThreadsIo\ThreadsIoService;

// The ThreadsIoClient class is the low level class used to make the API calls.
// It takes your eventKey in parameter, which is provided to you by Threads.io
$client = new ThreadsIoClient(YOUR_EVENT_KEY);

// The ThreadsIoService class is the high level class that you will use with the Entities to make your API Calls
// It takes your fresh new ThreadsIoClient object in argument to be instantiate
$service = new ThreadsIoClient($client);
```

The two main compound of this package are the **ThreadsIoClient** and **ThreadsIoService**.

The **ThreadsIoClient** is a programmatic implementation of the Threads.io API. It ensures that the data are sent with the format expected by the API.
The **ThreadsIoService** is the main class to instantiate and use. It's meant to use the package Entity system, meaning manipulating **Users**, **Event** and **Page** objects easily. Every call methods expects an object implementing the **<Entity>ThreadableInterface** or one of the provided Entity of this package.

Interfaces and Entites
----------------------

As explained earlier, the **ThreadsIoService** is manipulating entities. A User entity, Event entity or Page entity is the instantiation of an existing class of your PHP application implementing respectively the **UserThreadableInterface**, **EventThreadableInterface**, **PageThreadableInterface**. For instance, a Member class that is used for manipulating users in your application is a good candidate for implementing the **UserThreadable** interface.
If you have no classes that could implement the ThreadableInterfaces, you can instantiate manually one of the Wabel\Entities (User, Event or Page) provided in this package.

```php
use \Wabel\ThreadsIo\Entities\User;
use \Wabel\ThreadsIo\Entities\Event;
use \Wabel\ThreadsIo\Entities\Page;

// Whether you retrieve an object implementing the UserThreadableInterface from your DB...
$yourUser = $dao->getMemberById(2103);

// ...or that you create one using the provided entity class User...
$threadsIoUser = new User("ID254632", [
    "name" => "Jesus Christ",
    "company" => "Christian Church",
    "date_of_birth" => "24/12/0001",
]);

...

// ... you'll be able to use them both with the ThreadsIoService
$service->identify($yourUser);
$service->identify($threadsIoUser);
```

How to use the ThreadsIoService
-------------------------------

In version 1.0.0, we introduced the first use of the basic functions "identify", "track", "page" and "remove".
Here's a basic usage of the service :


```php
use \Wabel\ThreadsIo\Entities\User;
use \Wabel\ThreadsIo\Entities\Event;
use \Wabel\ThreadsIo\Entities\Page;
use \Wabel\ThreadsIo\ThreadsIoClient;
use \Wabel\ThreadsIo\ThreadsIoService;

// Instantiate an object that implements one of the Wabel\ThreadsIo\Interfaces
// (one of the provided classes in this case)
$user = new User("4815162342", [
     "name" => "Hugo Reyes",
     "status" => "Lost",
     "other" => "Lottery winner"
 ]);

$event = new Event("New Lost Person Report", [
     "plane" => "Oceanic 815",
     "crash_location" => "Pacific Ocean"
 ]);

$page = new Page("New plane crash: Oceanic 815 on fire in the Pacific Ocean", [
     "url" => "http://www.bignews.com/New-plane-crash-Oceanic-815-on-fire-in-the-Pacific-Ocean",
     "referer" => "http://www.bignews.com",
     "time_spent_on_page" => "18s"
 ]);

// Then grab or create a ThreadsIoService object
$client = new ThreadsIoClient($eventKey);
$service = new ThreadsIoService($client);

// Your now able to :

// Identify a user
$service->identify($user);

// Track an event
$service->track($user, $event);

// Track a page view
$service->page($user, $page);

// Remove a user
$service->remove($user);

```

About Threads.io
----------------
[Threads.io](https://threads.io/) provide a service meant for sending "Automated Behavior-Driven Emails" based on user activity and workflow rules setted by the account administrator.
You can consult the original API [here](https://docs.threads.io/). Feel free to make any pull requests if you notice any API upgrades.

About Wabel
----------------
[Wabel](http://www.wabel.com) is the online marketplace for the european food industry. In our effort to integrate our web platform to more and more web services, we (Wabel's dev team!) are happy to share our work with Threads.io's community.