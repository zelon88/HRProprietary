<?php
// / -----------------------------------------------------------------------------------
// / Copyright Information ...
// / HRProprietary Engine, Copyright on 9/7/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License Information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / File Information ...
// / v3.9.2.
// / This is the configuration an application built on this Engine starts from.
// / It holds the settings the ENGINE reads & nothing else. Everything your application
// / needs is yours to add below.
// /
// / Every setting here has a default that works on a normal host. Change what you need &
// / leave the rest, & read the sentence above a setting before changing it.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------

// / -----------------------------------------------------------------------------------
// / A component may only be loaded by an application.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! A configuration file cannot be loaded directly!');
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// /  --Configuration Version--
// /   Bump this when you add or remove a REQUIRED setting, & bump the version your
// /   application requires at the same time. A configuration missing a required setting is
// /   refused at startup, & the version is what tells an administrator why.
$ConfigVersion = 'v3.9.2';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// /  --Application Name--
// /   Used in log entries, error numbers & anywhere this application names itself.
// /   Pick something short. It is printed a great deal.
$ApplicationName = 'ExampleApp';

// /  --Application Title--
// /   The longer name, for a page title or a banner.
$ApplicationTitle = 'An application built on the HRProprietary Engine';

// /  --Verbose--
// /   Whether normal activity is logged. Warnings & errors are always written.
// /   TRUE while you are building. FALSE once a log is something you read rather than watch.
$Verbose = TRUE;
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// /  --Enable Memory Protection--
// /   Whether purgeSensitiveMemory() shreds a value or merely releases it.
// /   Leave it TRUE. The cost is small & the reason it exists is in
// /   Documentation/CODING_CONVENTIONS.txt under the memory conventions.
$EnableMemoryProtection = TRUE;
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// /  --Data Locations--
// /   Where this application keeps the files it is working on.
// /   $ConvertLoc is the primary one. $AdditionalConvertLocs lets an installation spread
// /   across more than one disk, & the Engine picks whichever has room.
// /   NEVER point any of these at a system directory. The Engine refuses to modify one
// /   recursively & will say so, but a refusal is a late place to find out.
$ConvertLoc = '/DATA/ExampleApp';
$AdditionalConvertLocs = array();

// /  --Log Directory--
// /   Where log files are written. The account this application runs as must own it.
$LogDir = '/DATA/ExampleApp/Logs';

// /  --Manager Socket Directory--
// /   Where the manager sockets live. It is created 0700 & belongs to the web server
// /   account. Nothing else should be able to reach it.
$ManagerSocketDir = '/DATA/ExampleApp/Sockets';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// /  --Require Sandbox--
// /   Whether a command that cannot be sandboxed is REFUSED rather than run unprotected.
// /   TRUE is the safe answer & is what an appliance should run.
// /   FALSE lets work continue on a host where Bubblewrap is unavailable, at the cost of
// /   running dependencies with nothing between them and the host.
$RequireSandbox = TRUE;

// /  --Require Sandbox On Docker--
// /   Whether the rule above still applies inside a container.
// /   A container is not a sandbox. It is a boundary around the whole application rather
// /   than around one command, so a compromised dependency still has everything the
// /   application has.
$RequireSandboxOnDocker = TRUE;
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// /  --Environment Manager May Repair--
// /   Whether the Environment Manager may change this host, or only report on it.
// /   It runs as root on a timer, opens no socket & reads no input from anywhere but this
// /   file. See Documentation/ABOUT_ENVIRONMENT_MANAGER.txt.
// /   FALSE means it looks & logs. Run it that way until you have read what it would do.
$EnvironmentManagerMayRepair = FALSE;
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / Everything below here is YOURS. The Engine reads none of it.
// / -----------------------------------------------------------------------------------
?>
