<?php

namespace App\Service;

use App\Entity\DbLogs;
use DateTimeInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class DbLoggerHandler
{
    private LoggerInterface $logger;
    private DateTimeInterface $dateTime;

    public function __construct ( LoggerInterface $loggerInterface, DateTimeInterface $dateTime )
    {
        $this->logger = $loggerInterface;
        $this->dateTime = $dateTime;
    }

    public function dbLoggerInfo(string $message, array $context )
    {
        $this->logger->info( $message, $context );
        
        $dbLog = new DbLogs();

        $dbLog->setLevel( 'info');
        $dbLog->setMessage( $message );
        $dbLog->setContext( $context );
        // $dbLog->setDataLog( $this->dateTime->);
 
    }

}