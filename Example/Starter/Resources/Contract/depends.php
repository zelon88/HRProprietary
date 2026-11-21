<?php
// / -----------------------------------------------------------------------------------
// / Copyright information ...
// / HRProprietary Engine, Copyright on 11/20/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / Application information ...
// / The Starter is the smallest application the HRProprietary Engine runs. It answers the
// / Engine's commands & one of its own, & offers no web interface.
// /
// / File information ...
// / v4.3.2.
// / The Starter's Dependency Manifest, the application's half.
// / This file is data. It defines nothing & does nothing.
// / The Engine's verifyDependsManifest() reads it. Nothing else may.
// / The manifest has two halves, as config.php does. What the Engine needs whatever application bundles it, PHP, its
// / extensions, the web server, Curl, Git, Bubblewrap & AppArmor's tools, is the Engine's half, Resources/Engine/depends.php,
// / & this half is what the application needs beyond that. The two are read as one list, the Engine's first, so a name
// / here may be Required of one there, as PHP Zip requires PHP. A name is in one half only.
// / The Starter needs nothing beyond the Engine's half, so its list is empty. An application adds an entry for each program
// / it runs, laid out as the entries of the Example's Resources/Contract/depends.php are, & raises $DependsVersion.
// /
// / Hardware requirements ...
// / This application requires at least a Raspberry Pi Model B+ or greater.
// / This application will run on just about any x86 or x64 computer.
// /
// / Dependency requirements ...
// / This file & Resources/Engine/depends.php are the authoritative list of dependencies, & nothing else is.
// / Run  php app.php -v  to see what this installation has.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------

// / -----------------------------------------------------------------------------------
// / Refuse direct execution. This file is a component & has no standalone context.
// / This halt cannot use quickDie. Reaching this line means app.php was never
// / loaded, so quickDie is not defined & calling it would replace a clear refusal with an
// / undefined function error.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! Starter-2: This file cannot process your request! Please submit your request to app.php instead!'.PHP_EOL);
// / -----------------------------------------------------------------------------------

// / -----------------------------------------------------------------------------------
// / The component version. app.php reads this without executing the file.
$DependsVersion = 'v4.3.2';
// / -----------------------------------------------------------------------------------

// / -----------------------------------------------------------------------------------
// / What the Starter needs beyond the Engine's half. Nothing.
$DependsManifest = array();
// / -----------------------------------------------------------------------------------
