#!/usr/bin/perl

use strict;
use warnings;
# use File::Copy::Recursive;
use File::Copy::Recursive qw(fcopy rcopy dircopy fmove rmove dirmove);

# my $orig = "/home/thiago/public_html/components/com_content";
# my $new = "./com_content";

my $orig = $ARGV[0] . $ARGV[1];
my $origAdm = $ARGV[0] . "/administrator/component/" . $ARGV[1];
my $dest = $ARGV[1];
my $component = $ARGV[1];
my $componentDir = $component . "/component";
my $administratorDir = $component . "/administrator";

mkdir $component;

print "$origAdm\n";

dircopy($orig,$componentDir) or die $!;
dircopy($origAdm,$administratorDir) or die $!;

