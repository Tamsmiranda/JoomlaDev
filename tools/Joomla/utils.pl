#!/usr/bin/perl

# sub componentName{
#	$name = @_;
#	print $name;
#}

#&componentName("asdasdasd");

$componentName = "com_aontenaA";
print "Testando component name\n";
if ( $componentName =~ /^com_([a-z0-9].)/ ) {
	print "Nome correto\n";
} else {
	print "Nome errado\n";
}
