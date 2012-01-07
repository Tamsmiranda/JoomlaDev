@echo.
@echo off

php -q jake.php %*

echo.

exit /B %ERRORLEVEL%
