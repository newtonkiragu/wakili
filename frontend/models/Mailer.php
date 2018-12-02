<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\models;

use Yii;
use yii\base\Component;
use yii\base\Event;

/**
 * Mailer.
 *
 * @author Michael Mutinda
 * 
 * 
 * 
 */
class MessageSent extends Event {

    public $message;
    public $to;
    public $path;
    public $subject;

}

class Mailer extends Component {

    /** @var string */
    public $viewPath = '@app/mail';

    /** @var string|array Default: `Yii::$app->params['adminEmail']` OR `no-reply@example.com` */
    public $sender;

    const EVENT_SEND_MAIL = 'sendMail';

    

    public function sendMail($to, $subject, $message, $path='') {
        $event = new MessageSent;
        $event->message = $message;
        $event->to = $to;
        $event->subject = $subject;
        $event->path = $path;
        $this->trigger(self::EVENT_SEND_MAIL, $event);
        $this->off(self::EVENT_SEND_MAIL);
    }

  

    /**
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array  $params
     *
     * @return bool
     */
    public static function  sendMessage($event) {
      
        Yii::$app->mailer->compose()
                ->setFrom('from@domain.com')
                ->setTo($event->to)
                ->setSubject($event->subject)
                //  ->attach('http://localhost:8080/lawyer/assets/Emailatachments/Chapter13.pdf')
                ->setHtmlBody($event->message)
                ->send();
    }

    public function sendMany() {
        $messages = [];
        foreach ($users as $user) {
            $messages[] = Yii::$app->mailer->compose()
                    // ...
                    ->setTo($user->email);
        }
        Yii::$app->mailer->sendMultiple($messages);
    }

}
