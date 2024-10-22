<?php
namespace Drupal\custom_event_module\EventSubscriber;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\user\Event\UserLoginEvent;
use Drupal\user\UserEvents;
class CustomEventSubscriber implements EventSubscriberInterface {
    /**
    * Responds to user login events.
    *
    * @param \Drupal\user\Event\UserLoginEvent $event
    * The event object.
    */
    public function onUserLogin(UserLoginEvent $event) {
        $account = $event->getAccount();
        \Drupal::logger('custom_event_module')->notice('User @name has logged in.',['@name' => $account->getDisplayName()]);
    }
    
    /**
    * {@inheritdoc}
    */
    public static function getSubscribedEvents() {
        $events[UserEvents::USER_LOGIN][] = ['onUserLogin'];
        return $events;
    }
}