rem use reverse.cmd joomlapath com_name


md ..\components\%2\administrator\
md ..\components\%2\component\
xcopy /e /y %1\administrator\components\%2\*.* ..\components\%2\administrator\
xcopy /e /y %1\components\%2\*.* ..\components\%2\component\