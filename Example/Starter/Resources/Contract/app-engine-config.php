<?php
// / -----------------------------------------------------------------------------------
// / Copyright Information ...
// / HRProprietary Engine, Copyright on 11/20/2026 by Justin Grimes, www.github.com/zelon88
// /
// / License Information ...
// / This project is protected by the GNU GPLv3 Open-Source license.
// / https://www.gnu.org/licenses/gpl-3.0.html
// /
// / File Information ...
// / v4.3.2.
// / The Starter's Engine settings, loaded after engineConfig.php, so anything it sets wins.
// / A package ships a configuration with working defaults, & the thing being configured drops a file beside it that overrides what it needs, as Apache & PHP do.
// / engineConfig.php belongs to the Engine & is replaced wholesale when a newer Engine arrives, while this file belongs to the application & survives that.
// / So an Engine upgrade is a directory copy.
// / Set only what differs, because a setting repeated here at the Engine's value silently stops tracking the Engine's default when that default changes.
// / This is the smallest contract the Engine runs an application on. Each name the Starter leaves out is one the Engine falls back from, & ABOUT_ENGINE_CONTRACT.txt
// / says what each does. The Example's contract, at Example/HRConvert2/Resources/Contract/app-engine-config.php, sets every one.
// /
// / <3 Open-Source
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / A component may only be loaded by the core.
if (!isset($CoreLoaded) or $CoreLoaded !== TRUE) die('ERROR!!! Starter-35000, An engine configuration cannot be loaded directly!');
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / What this application is called.
// / The Engine uses the name in log entries & error numbers, & the slug wherever a name has
// / to survive a filesystem or a socket path.
$EngineApplicationName = 'Starter';

// / The Starter is started through app.php, which is the entry point the Engine assumes where a contract names none.
$EngineEntryPoint = 'app.php';
$EngineApplicationSlug = 'starter';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / Which way work moves through this application.
// / The Starter runs from a terminal & asks nothing privileged for permission, so no listening socket is opened at all.
// / An application whose web requests ask root for work keeps the Engine's default, 'requests-upward', as the Example does.
// / engineConfig.php says what each shape means.
$EngineDispatchDirection = 'work-downward';
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / The providers. Every one names a function this application defines, & the Engine calls what it is given without knowing anything else about it.
// / This is the whole of how the Engine learns about an application, through these names.
// / The Starter names the four every application needs, & leaves out the rest. It runs no sandboxed tool, keeps no policy on the host,
// / offers no workflows & no accounts, puts nothing on a schedule & adds nothing to -v, so it names no provider for any of those.
// / An Engine with none of them still runs & does less, which is the correct degradation rather than a failure.
// / See ABOUT_ENGINE_CONTRACT.txt.

// /   Returns the configuration model for this application's own half of config.php. What a config file cannot say about itself.
$EngineConfigModelProvider = 'applicationConfigModel';

// /   Returns what only this application knows for the help -h prints, its description, its arguments, its sections & its address.
$EngineHelpProvider = 'applicationHelpInfo';

// /   Moves a manager that has run for a while on to the logfile it should be writing now. It is the kernel's own.
$EngineLogProvider = 'refreshLogFile';

// /   Handles every argument beginning --app. The handler returns the exit status its command earned, which the kernel hands on
// /   as the status of the process.
$EngineApplicationArgumentHandler = 'applicationArgumentHandler';

// /   The defaults this application gives the Engine's settings, where the Engine's own would not do.
// /   A setting's name, documentation & default are the Engine's, in Resources/Engine/config-template.php, & a default here
// /   replaces only the value, in a config.php written from the templates & in what a reset writes.
// /   Each value is written as config.php writes it, so a string carries its quotes.
// /   The Starter names itself & its folders. It has no workflows & hands work downward, so the settings that offer
// /   workflows, resource awareness & a ceiling on each piece of work are off.
$EngineSettingDefaults = array(
  'InstLoc' => "'/var/www/html/HRProprietary/Starter'",
  'ConvertLoc' => "'/DATA/Starter'",
  'ApplicationName' => "'Starter'",
  'ApplicationTitle' => "'Starter'",
  'Verbose' => 'FALSE',
  'EnableWorkflows' => 'FALSE',
  'EnableWorkflowBuilder' => 'FALSE',
  'EnableWorkflowImportExport' => 'FALSE',
  'EnableResourceAwareness' => 'FALSE',
  'EnablePerConversionLimits' => 'FALSE');
// / -----------------------------------------------------------------------------------


// / -----------------------------------------------------------------------------------
// / The pipelines this application accepts & the exact version each must report.
// / This is an allowlist. A folder under Resources/Pipelines that is not named here is never
// / read, never required & never enumerated, however it got there. The Starter accepts none.
$EngineAcceptedPipelines = array();

// / Where each of this application's own pins reads its version from.
// / php app.php --build --pins --write writes every pin from the files named here,
// / so none of this application's pins is moved by hand. The kernel's & the Engine's are,
// / because the build runs inside both & cannot rewrite what loads it.
// / Paths are relative to the installation. The Engine knows where its own
// / components live, so they are not listed.
$EnginePinSources = array(
  'ConfigVersion' => 'Resources/Contract/config-template.php',
  'DependsVersion' => 'Resources/Contract/depends.php');

// / Every location this application keeps on disk, by the setting that holds it, & its role.
// / The role says what a location is. The Engine decides what that means for its owner & its
// / mode, & this contract cannot ask for a mode, so a location can never be made writable by
// / the account root is protecting itself from. -fp & the Environment Manager apply them.
// /   code       The installation. root's, 0755 & 0644, read by the web server account.
// /   data-root  The data location itself. root's & 0755, & never walked.
// /   secret     The folder secrets are kept in. root's, the web server account's group &
// /              0750, & never walked.
// /   web        A folder the web server account writes. 0700 & never walked by root.
// /   root-only  root alone. 0700 & 0600.
// /   shared     A folder other software shares. Checked & never walked.
// / See Documentation/ABOUT_MANAGED_LOCATIONS.txt.
// / The Starter keeps no folder of its own, so these are the Engine's, named as every application names them.
$EngineManagedLocations = array(
  'ProprietaryLoc' => 'shared',
  'InstLoc' => 'code',
  'DataRootLoc' => 'data-root',
  'SecretLoc' => 'secret',
  'SessionLoc' => 'web',
  'CacheLoc' => 'web',
  'LogDir' => 'web',
  'ManagerSocketDir' => 'web',
  'EngineDir' => 'root-only',
  'BackupLoc' => 'root-only',
  'EventLoc' => 'root-only');

// / The entries at the top of a release that make up the application, & nothing else.
// / -fp run from a tree that is not installed copies exactly these into the application folder
// / in the data location, & the hosted location loses only what is a copy of one of them.
// / Whatever else shares the folder a release was unpacked into is never taken along & never removed.
// / See Documentation/ABOUT_MANAGED_LOCATIONS.txt.
$EngineApplicationLayout = array('app.php', 'README.md', 'LICENSE', 'Documentation', 'Resources');

// / The settings in config.php that each shared name reads, & the values the kernel & the Engine work
// / out from them as they start. The shared layers ask for a value by a name that says nothing about
// / this application. HostedLocation is the folder the loader is kept in, ServerURL is the address of
// / that folder, & DocumentRoot is the web server's document root. MaintainProtectionFile says whether
// / the Engine keeps a protection file in a folder a web server could reach, & LiftNamespaceRestriction
// / whether -fp may lift the kernel's AppArmor restriction on unprivileged namespaces.
// / No workflow setting & no account setting is mapped, so this application has no workflows & no accounts, whatever config.php holds.
$EngineSettingNames = array(
  'HostedLocation' => 'HostedLoc',
  'ServerURL' => 'FullURL',
  'DocumentRoot' => 'ServerRootDir',
  'MaintainProtectionFile' => 'MaintainHTAccess',
  'LiftNamespaceRestriction' => 'AllowUnprivilegedNamespaces');
// / -----------------------------------------------------------------------------------
?>
