<?php

use App\Services\MailService;

$r->addRoute('GET', '/mail-validation/{token}', [MailService::class, 'validarEmail']);
