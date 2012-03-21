rem @echo off

rem use forward.cmd joomlapath com_name

rem Joomla Path
set JOOMLAPATH=%1

rem Component Name
set COMNAME=%2

:MAIN
if not exist "..\components\%2\administrator\" goto NOCOMPONENT
if not exist "..\components\%2\component\" goto NOCOMPONENT
if not exist "%1\" goto NOFOLDER

md %1\administrator\components\%2\
md %1\components\%2\
xcopy /h /r /e /y ..\components\%2\administrator\*.* %1\administrator\components\%2\
xcopy /h /r /e /y ..\components\%2\component\*.* %1\components\%2\
goto EXIT

:NOCOMPONENT
echo Component not exists
goto EXIT

:NOFOLDER
echo Directory not exists
goto EXIT

:EXIT