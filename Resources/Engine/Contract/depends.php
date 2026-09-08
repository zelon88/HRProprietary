<?php
// / -----------------------------------------------------------------------------------
// / Copyright Information ...
// / HRProprietary Engine, Copyright on 9/8/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License Information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / File Information ...
// / v3.9.3.
// / YOUR DEPENDENCY MANIFEST. What this installation needs & how to get it.
// / The Dependency Core reads it. --setup reports & installs from it. Nothing else knows
// / what is in here.
// /
// / One entry per dependency. The two below are the shape rather than a recommendation.
// /
// / FIELDS WORTH KNOWING BEFORE YOU WRITE ONE.
// /   Type            apt, source or bundled. Decides how it is installed.
// /   MinimumVersion  Compared NUMERICALLY. A string compare ranks 3.10 below 3.9.
// /   MaximumVersion  The first version NOT accepted. Omit it & anything newer passes.
// /   VersionSource   A command listing what is AVAILABLE. The Engine picks the newest
// /                   inside the window & hands it to BuildCommand as DEPENDENCY_VERSION.
// /   Architectures   Which machines this runs on. Anything else is reported unsupported
// /                   rather than probed & failed.
// /   Requires        Other entries by name. Reported as waiting rather than as broken.
// /   Purpose         Why it is here. An entry nobody can justify is one nobody will dare
// /                   remove later.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A component may only be loaded by an application.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! Engine-35000, A manifest cannot be loaded directly!');
$DependsVersion = 'v3.9.3';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / The manifest.
$DependencyManifest = array(

  // / An interpreter that is already present on essentially every host. It is here to show
  // / a version window & nothing else.
  array('Name' => 'PHP', 'Binary' => 'php', 'Type' => 'apt', 'Package' => 'php-cli',
    'MinimumVersion' => '8.0', 'VersionCommand' => 'php -v', 'VersionPattern' => '/PHP (\\d+\\.\\d+)/',
    'BuildCommand' => '',
    'Required' => TRUE, 'Subsystem' => 'Core', 'Requires' => array(),
    'License' => 'PHP-3.01', 'Source' => 'https://www.php.net', 'Purpose' => 'Runs this application.'),

  // / The sandbox the Engine uses. Without it, nothing the Engine runs is contained.
  array('Name' => 'Bubblewrap', 'Binary' => 'bwrap', 'Type' => 'apt', 'Package' => 'bubblewrap',
    'MinimumVersion' => '', 'VersionCommand' => 'bwrap --version', 'VersionPattern' => '/bubblewrap (\\d+\\.\\d+)/',
    'BuildCommand' => '',
    'Required' => FALSE, 'Subsystem' => 'Core', 'Requires' => array(),
    'License' => 'LGPL-2.0', 'Source' => 'https://github.com/containers/bubblewrap', 'Purpose' => 'Sandboxes every command the Engine runs on your behalf.'),
);
// / -----------------------------------------------------------------------------------
?>
