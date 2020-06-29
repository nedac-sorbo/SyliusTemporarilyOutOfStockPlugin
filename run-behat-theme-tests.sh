#!/usr/bin/env sh
set -eux

vendor/bin/behat --tags=@theme_setup
(cd tests/Application && bin/console ca:cl)
vendor/bin/behat --tags=@theme
