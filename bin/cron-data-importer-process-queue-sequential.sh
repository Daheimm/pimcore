#!/bin/bash
cd /var/www/html && /var/www/html/bin/console datahub:data-importer:process-queue-sequential 
