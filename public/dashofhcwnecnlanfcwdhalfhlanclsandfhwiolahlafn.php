<?php
exec("cd /var/www/api");
exec("git fetch --all");
exec('git checkout --force "origin/master"');