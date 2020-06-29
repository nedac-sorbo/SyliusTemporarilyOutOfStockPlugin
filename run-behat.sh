#!/usr/bin/env bash
set -eux

cd tests/Application
if [[ $(git status | awk '{print $3}' | head -n1) == "1.7-bootstrap-theme" ]]; then
	vendor/bin/behat --tags=@theme_setup
	(cd tests/Application && bin/console ca:cl)
	vendor/bin/behat --tags="@theme" --strict -vvv --no-interaction || vendor/bin/behat --tags="@theme" --strict -vvv --no-interaction --rerun
else
	vendor/bin/behat --tags="~@theme&&~@theme_setup" --strict -vvv --no-interaction || vendor/bin/behat --tags="~@theme&&~@theme_setup" --strict -vvv --no-interaction --rerun
fi
