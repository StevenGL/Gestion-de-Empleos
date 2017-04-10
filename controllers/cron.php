<?php


$app->group('/cron', function () use ($app) {
    
    // expire jobs
    $app->get('/jobs/expire/:cron_token', function ($cron_token) use ($app) {
        
        if (trim($cron_token) == CRON_TOKEN) {
            $j = new Jobs();
            $j->expireJobs();
            echo true;
            exit();
        }
    });
    
});
