<?php

namespace Rc2c\ThecallrBundle\Utils;

class TheCallr
{
    protected $srevice = null;
    protected $from    = null;
    
    public function __construct($account , $auth , $from)
    {
        try {
            $this -> service = new \ThecallrClient($account, $auth);
            $this -> from = $from;
        } catch(\Exception $e) {
            $msg = $this -> getErrorMessage($e);
            throw new \Exception(sprintf('Erreur de connection API thecallr !'.$msg));
        }
    }
    
    public function getService()
    {
        return $this -> service;
    }

    public function send($to, $message)
    {
        $options = new \stdClass();
        $options -> flash_message = false;
        
        try {
            return $this -> service -> call('sms.send', $this -> getFrom(), $to, $message, $options);
        } catch(\Exception $e) {
            $msg = $this -> getErrorMessage($e);
            throw new \Exception('Erreur thecallr : '.$msg , $e -> getCode());
        }
    }
    
    public function getFrom()
    {
        return $this -> from;
    }
    
    /**
     * Retourne le message d'erreur en fonction du code erreur
     * @param  [type] $errorCode [description]
     * @return [type]            [description]
     */
    protected function getErrorMessage(\Exception $error)
    {
        $msg = "";
        switch($error -> getCode()) {
            case 100:
                $msg = "Fonctionnalité non autorisée, contactez le support thecallr";
             break;
             break;
            case 1000: 
                $msg = "Erreur lors du routing SMS";
            break;
            default: 
                $msg = $error -> getCode().'-'.$error -> getMessage();
            break;
        }

        return $msg;
    }
}