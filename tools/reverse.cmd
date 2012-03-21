rem @echo off

rem use reverse.cmd joomlapath com_name

rem Joomla Path
set JOOMLAPATH=%1

rem Component Name
set COMNAME=%2

:MAIN
if not exist "%1\administrator\components\%2\" goto NOCOMPONENT
if not exist "%1\components\%2\" goto NOCOMPONENT
if not exist "%1\" goto NOFOLDER

md ..\components\%2\administrator\
md ..\components\%2\component\
xcopy /e /y %1\administrator\components\%2\*.* ..\components\%2\administrator\
xcopy /e /y %1\components\%2\*.* ..\components\%2\component\
goto EXIT

:NOCOMPONENT
echo Component not exists
goto EXIT

:NOFOLDER
echo Directory not exists
goto EXIT

:EXIT