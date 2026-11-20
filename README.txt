----------------------------------------------------------------------------------------------------------------------------------------------------------------
COPYRIGHT INFORMATION ...
HRProprietary Engine, Copyright on 9/4/2026 by Justin Grimes, www.github.com/zelon88

LICENSE INFORMATION ...
This project is protected by the GNU GPLv3 Open-Source license.
https://www.gnu.org/licenses/gpl-3.0.html

APPLICATION INFORMATION ...
The HRProprietary Engine provides a coherent application environment. It is bundled with an application rather than installed beside one.

FILE INFORMATION ...
v4.3.1.
This plain text file says what the Engine starter kit holds & what a new application supplies to run on it.

HARDWARE REQUIREMENTS ...
This application requires at least a Raspberry Pi Model B+ or greater.
This application will run on just about any x86 or x64 computer.

DEPENDENCY REQUIREMENTS ...
What the Engine itself needs is Resources/Engine/depends.php, & --setup installs it with the application's own half. Run  php <entry point> -v  to see what an installation has.

<3 Open-Source
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What This Kit Holds--

Every file here is from the HRConvert2 v4.3.0 release tree but those Documentation/ENGINE_CHANGELOG.txt
names under v4.3.1. ScanCore/ & Pipelines/ moved into Resources/, where an application keeps them.

  Resources/Kernel/              The kernel, v4.3.1. Copied into every application unchanged.
  Resources/Engine/              The Engine, v4.3.1. engine.php, engineConfig.php, the Engine's half
                                 of config.php in config-template.php, the Engine's half of the
                                 dependency manifest in depends.php, every Core, every Manager,
                                 Sandbox/, the passwd, group & machine-id a sandbox shows, & UI/, the
                                 protection page's template & the Engine's logo. Copied into every
                                 application unchanged. See --This Kit's Engine--.
  Resources/Pipelines/           Every pipeline HRConvert2 v4.3.0 ships, ClamAV & ScanCore as HRProtect
                                 mended them, HRProtect's Quarantine, & the shared modules they load.
                                 Copied into an application's Resources/Pipelines a folder at a time.
                                 See --The Pipeline Library--.
  Resources/ScanCore/            The ScanCore program the ScanCore pipeline runs, v1.9. Copied into an
                                 application's Resources/ScanCore with that pipeline, as it is here.
  Example/HRConvert2/            HRConvert2's entry point, version file, contract & bootstrap script,
                                 & the build scripts its manifest names. The worked example. Read it,
                                 & copy none of it whole. Its pins & its contract follow this kit.
  Documentation/                 The Engine's documents, the conventions the code is written to,
                                 ENGINE_CHANGELOG.txt, the record of every change made to the Engine
                                 itself, & each application's record of the changes it made to its
                                 copy, ENGINE_RECONCILIATION_HRCONVERT2.txt & _HRPROTECT.txt.
  Documentation/Logos/           The logos README.md shows. An application does not copy them.
  Documentation/Build/           The two code checkers, the documentation checker &
                                 hrconvert2-release-fetch.sh, which fetches & checks the release
                                 binary a manifest entry names, as four pipeline tools' entries do.
  Documentation/Build/Tests/     The Engine's own tests, the library they share & the runners that
                                 keep them in bubblewrap, kept so an application's developer runs
                                 them rather than writing their own. Its README.txt says how.
  LICENSE                        The GNU GPLv3.
  README.md                      The repository's introduction.

Documentation/ABOUT_ENGINE_CONTRACT.txt is the authority on everything below. This file is the
order to do it in.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--This Kit's Engine--

THIS ENGINE IS CANON, v4.3.1, & IT RECONCILES BOTH APPLICATIONS' COPIES.
Every application carries its own copy of the Engine, & each may change its copy & record the change
in its own reconciliation file. The Engine's maintainer merges the copies into one Engine by hand.
This one is the v4.2.4 kit's Engine with HRConvert2's changes to its v4.3.0, which
ENGINE_RECONCILIATION_HRCONVERT2.txt records, & HRProtect's to its v0.0.7, which
ENGINE_RECONCILIATION_HRPROTECT.txt records. ENGINE_CHANGELOG.txt says what v4.3.1 made of them.
Canon is stamped plainly. An application's copy is v4.3.1r where it is canon's unchanged, & v4.3.1ur
where the application has changed it. CODING_CONVENTIONS.txt says how a mark is compared.

  The kernel                 v4.3.1     HRProtect's sanitizePath(), printableText() &
                                        enterFolderWithoutFollowing(). An --app handler sets the exit
                                        status, & a file the kernel opens is never handed to a command.
  The Engine                 v4.3.1     HRConvert2's sandbox, to v4.3.0. HRProtect's worker & timers of
                                        an application's own. One protection page, built from UI/.
  The Setup Core             v4.3.1     HRConvert2's repair of a displayed section, & HRProtect's
                                        timers & the folders an application declares.
  The Workflow Core          v4.3.1     HRProtect's printing of text nobody vetted.
  The Event Core             v4.3.1     HRProtect's, & the Engine's from here. It keeps the record of
                                        what an application did & found.
  The Dependency Core        v4.2.5     A Fallback may fetch a release binary, & a program that cannot
                                        say its version is given its own copy.
  The Environment Core       v4.3.1     Pinned by the Engine, which does not start without it. Its copies
                                        of three kernel functions, which never loaded, are gone, & it
                                        builds no protection page of its own.
  Every other Core           As the v4.2.4 kit's. Pipeline v4.2.4, Authentication v4.2.3, Email
                             v4.2.0.
  Every manager              As the v4.2.4 kit's.
  engineConfig.php           v4.3.1. $EngineTimerProvider & $EngineProtectionLogo are new, & five
                             gates nothing read are gone.
  The Engine's settings      config-template.php v4.3.1. --Record Events-- moved into it from
                             HRProtect's half. v4.2.7 changed only the comments on --Require Sandbox--
                             & --Require Sandbox On Docker--.
  The Engine's manifest      As the v4.2.4 kit's, v4.2.4.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--The Three Tiers--

  The kernel        Loaded first, by the entry point, & pinned exactly. It logs, halts, shreds memory,
                    sanitizes input, keeps the install secret & a visitor's session, & boots the
                    installation. verifyInstallationState() finds who runs the process, reads
                    versionInfo.php & config.php, derives the data locations & every account's home, &
                    reads the install secret. loadEngine() loads the Engine & has it start,
                    runCommandLine() reads the command line & admitWebRequest() admits a web request.
                    It names no application.
  The Engine        Loaded once the installation is verified, & pinned exactly. The environment every
                    application needs. Its start, a session's folders, its settings, its command line,
                    its repair (-fp & --setup), its report (-v) & its help (-h), the sandbox, the
                    listener & its managers, its own dependencies & the application's, pipelines,
                    workflows, accounts, the configuration utility & updates.
  The application   Its version pins, its own settings & its logic. What the Engine calls in it is named
                    in its contract, Resources/Contract/app-engine-config.php, & nowhere else.

The Engine never calls application code except through a name the contract gives it, & the kernel
never calls the Engine without asking whether it is loaded. Checks eight & nineteen of the Python
checker hold both.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What A New Application Supplies--

1. AN ENTRY POINT at the application root. Its boot is calls, in this order, as convertCore.php's main logic is.
  a. $DefaultApplicationName names the application until config.php does, & $RequiredKernelVersion pins
     the kernel. The kernel's version is read from the file without running it, a missing or mismatched
     kernel is refused with a plain print & exit(1), & the kernel is required.
  b. verifyCodeIsTrustedByRoot(dirname(__FILE__), basename(__FILE__)).
  c. setTimeLimit() & verifyTime().
  d. Its own verifyInstallation(). It sets $CoreLoaded TRUE, declares every pin below & calls
     verifyInstallationState(__FILE__, its version, the oldest config.php it accepts).
  e. Its own input handling, with sanitize() on every input, then verifySession(), verifyTokens() &
     verifySesHash().
  f. Resources/Engine/engineConfig.php, required at global scope. It loads the contract last.
  g. verifyLogs().
  h. loadEngine(). The Engine starts itself & establishes the request's session, its folders & its address.
  i. Its own globals, which are its own & nothing the Engine reads.
  j. runCommandLine(basename(__FILE__)). Where that is not a command line, admitWebRequest(basename(__FILE__)),
     then its own logic, & finishWebRequest() once everything it serves has been printed.

2. RESOURCES/VERSIONINFO.PHP holding $Version, the application's version. The kernel refuses an entry
   point whose version differs, error 28001.

3. RESOURCES/CONTRACT, which the kernel finds through contractPath().
  config-template.php     The application's half of config.php. The header & the guard a config.php
                          opens with, $ConfigVersion & every setting only the application reads, each
                          documented above its line. Copy HRConvert2's opening & replace its settings.
  app-engine-config.php   Its identity, $EngineApplicationName, $EngineEntryPoint & $EngineApplicationSlug.
                          The providers the Engine calls, the pipelines & shared modules it accepts at
                          which versions, its managed locations, its layout, the folders every session
                          holds, the map from the Engine's names for settings to its own in
                          $EngineSettingNames, & in $EngineSettingDefaults the defaults it gives the
                          Engine's settings, its name, its title, its folders & where its updates come from.
  depends.php             The application's half of the dependency manifest, what its own pipelines run.
                          The Engine's half ships with the Engine, & an entry here may name one of its
                          entries in Requires, as HRConvert2's PHP Zip names PHP.

4. A CONFIGURATION MODEL, a function named in $EngineConfigModelProvider that models each setting of the
   application's half, as applicationConfigModel() does. The kernel reads the names in both halves of
   the template, makes each a global & refuses a config.php without one, so nothing else lists them.
   php <entry point> --config --repair writes config.php from both halves the first time.

5. THE PINS, declared in verifyInstallation(), except the kernel's, which is declared before the kernel loads.
  $RequiredKernelVersion & $RequiredEngineVersion       Exact. Moved by hand, because the build runs inside both.
  $RequiredSetupCoreVersion, $RequiredDependencyCoreVersion, $RequiredPipelineCoreVersion,
  $RequiredWorkflowCoreVersion, $RequiredAuthenticationCoreVersion, $RequiredEmailCoreVersion
  & $RequiredEventCoreVersion                           Exact. Every Core ships with the Engine & -v reports each,
                                                        so each is pinned whether or not the application uses it.
  $RequiredDependsVersion                               Exact, its own half of the manifest's. The Engine pins
                                                        its half itself.
  $RequiredConfigVersion                                The oldest config.php accepted. Raised when either half
                                                        of the template gains or loses a setting.
  $RequiredSecretVersion                                The install secret file it writes & accepts. Exact.
                                                        HRConvert2's is v3.7.7.
  $RequiredConfigScript                                 The bootstrap script, Documentation/Build/<slug>-setup.sh,
                                                        if it ships one. One that is absent is not a fault.
  $EngineApplicationVersion                             Its own version, handed to the Engine where it is defined.

6. WHAT IT ADDS TO THE ENGINE, each optional & each named in its contract.
  $EngineHelpProvider               What -h prints of its own, as applicationHelpInfo() returns it.
  $EngineReportProvider             Rows & sections -v prints in the places it leaves, as applicationVersionReport().
  $EngineSandboxProvider            The sandbox profile of each tool it runs, as getSandboxProfiles(). A profile
                                    sets RequireSandbox TRUE where its tool reads a file an upload names.
  $EngineSessionFolders             The folders every session holds beyond StreamTemp. Each is a global of its
                                    own name holding its path. HRConvert2 names ScadTemp.
  $EngineApplicationArgumentHandler Every command beginning --app. HRConvert2 names none.
  $EnginePolicyChecks               The policies it keeps on the host, each checked & repaired with the Engine's.
  $EngineRepairProvider             A repair of anything else it keeps.
  $EngineOperatorPrompt             How it asks its operator, where the terminal will not do.
  $EngineLogProvider                How a long running manager moves on to the logfile it should be writing.
  $EngineOperationProvider          The operations a workflow may run, if it offers workflows.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What Is No Longer Copied--

The Engine pass left four things in HRConvert2's convertCore.php that a new application would have
copied. v4.2.4 moved each, so none is copied & ENGINE_MIGRATION_STATUS.txt, step eighteen, says how.

  The Engine's load & what follows it      The kernel's loadEngine() & the Engine's startEngine().
  The globals verifyGlobals() set for it   The Engine's establishEngineSession(), & the kernel's
                                           $DirSep, $Lol, $Lolol, $Append & $ManagerSocketDir.
  The command line                         The kernel's runCommandLine() & the Engine's
                                           runEngineCommandLine(), -u & -h included.
  The Engine's own dependencies            Resources/Engine/depends.php.

The Engine reads no global the application alone sets but its pins. The allowed formats are read
through $EngineSettingNames as AllowedExtensions, & --File Operation Retry Count-- is the Engine's.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--The Pipeline Library--

Resources/Pipelines/ holds every pipeline HRConvert2 v4.3.0 ships, & Shared/, the modules several of
them load, workFolder.php, libreOffice.php, ffmpegDemuxers.php & imageMagickDecoders.php.
A pipeline is adopted whole. Its folder carries its code, its declarations in pipelineConfig.php, a
README.md written from them & its approval record, DEPENDENCY_APPROVALS.txt. pipelineConfig.php
declares its version, its kind, its entry point, its subsystem, its shared modules, its tools & the
block of error numbers that belongs to it. Documentation/ABOUT_PIPELINE_COMPONENTS.txt says what each
declaration means.

ClamAV & ScanCore are v4.3.1, as HRProtect mended them. ClamAV returns a verdict for every path, &
both read what they need through applicationSetting(), so an application maps ScannerScratchFolder,
ScanCoreMemoryLimit, ScanCoreChunkSize, ScanCoreVerbose & ScanCoreDebug in $EngineSettingNames, as
the Example's contract does. Quarantine is HRProtect's, v4.3.1. It is handed its folder, names no
application & runs from the command line alone.

Every Engine function a pipeline calls is in this kit's Engine. Every folder is the one HRConvert2
v4.3.0 ships on it & was tested on it, but for those three, which HRProtect v0.0.7 ships & tested.

An application adopts a pipeline in seven steps.

  1. Copy its folder into the application's Resources/Pipelines, with Resources/Pipelines/index.html,
     every module its $PipelineSharedModules names from Resources/Pipelines/Shared, &
     Shared/index.html. Scan runs the scanner pipelines, so it is adopted with ClamAV, ScanCore or
     both. ScanCore is adopted with Resources/ScanCore/, copied as it is.
  2. Pin it. The folder's name & its $PipelineVersion go in $EngineAcceptedPipelines, & each shared
     module & its $SharedModuleVersion in $EngineAcceptedSharedModules. A folder the contract does not
     name is never loaded.
  3. Declare its tools. Each name in $PipelineDependencies is an entry in Resources/Contract/depends.php,
     under the subsystem $PipelineSubsystem names. Example/HRConvert2's depends.php holds every entry.
     An entry built by a script is adopted with the script. 7-Zip's, FFMPEG's & FFprobe's,
     ImageMagick's & Python's are in Example/HRConvert2/Documentation/Build, where ffmpeg-build.sh
     runs ffmpeg-build2.sh beside it. Dasel's, yq's, Pandoc's & Resvg's run
     Documentation/Build/hrconvert2-release-fetch.sh.
  4. Give it its sandbox profiles, below, in the function $EngineSandboxProvider names.
     Example/HRConvert2's getSandboxProfiles() holds every one. libreoffice, calibre, inkscape, resvg,
     dia, meshlab & ffmpeg set RequireSandbox, because each tool reads a file an upload names, so a
     conversion that runs one is refused where no sandbox can be built. calibre shows /opt/calibre,
     where Calibre's own installer puts it, because a sandbox does not show /opt.
  5. Supply the application's functions it calls, below. Each is in Example/HRConvert2's convertCore.php.
  6. Declare the application's settings it reads, below, in config-template.php & the configuration
     model, & set the globals it reads, below, as convertCore.php sets them.
  7. Add its errors to ERROR_DESCRIPTIONS.txt, as the Engine's catalogue is extended. The catalogue in
     this kit documents every block.

How an application offers a pipeline to its users is its own logic. HRConvert2 routes its conversion
families in applicationConversionFamilies(), whose kinds conversionFamilyClaims() reads, & its
operations in applicationOperations(), which its contract names in $EngineOperationProvider.

What each pipeline needs of the application, with its shared modules' needs counted as its own. A setting
is named as config.php names it, a global the application sets carries its $, & a blank needs nothing.

  Pipeline   Profiles                   Functions                         Settings & globals
  Archive    archive                    findFreeOutputName                AllowBootableIsoImage, MaxExtractedSize,
                                                                          MaxExtractedFiles, $BootableIsoArray &
                                                                          $BootloadersDir
  Archiver   archive                    verifyFile                        VirusScan
  Audio      ffmpeg
  ClamAV     clamav
  Data       dasel yq
  Document   poppler libreoffice
  Drawing    dia
  Ebook      calibre
  Email      msgconvert
  Extractor  archive                    placeSessionFile verifyFile       VirusScan, MaxExtractedSize, MaxExtractedFiles
                                                                          & $DearchiveArray
  Files
  Graph      graphviz                                                     GraphConversionTimeout
  Identify   imagemagick ffmpeg archive coverResolvedImageMagickPolicy
             poppler generic            findFreeOutputName verifyFile
  Image      imagemagick                coverResolvedImageMagickPolicy
  LaTeX      xelatex                                                      LaTeXConversionTimeout
  Markup     pandoc                                                       MarkupConversionTimeout
  Metadata   mat2                       metadataOperationFormats          VirusScan
                                        placeSessionFile verifyFile
  Model      meshlab                                                      UsePyMeshLab
  OCR        tesseract libreoffice      coverResolvedImageMagickPolicy    VirusScan
                                        verifyFile
  PDF        poppler                    placeSessionFile verifyFile       VirusScan, MaxExtractedSize, MaxExtractedFiles
  SVG        inkscape resvg
  Scad       openscad                   getFiles                          SCADConversionTimeout,
                                                                          AllowSCADIncludeResolution & $ScadTemp, a
                                                                          folder $EngineSessionFolders names
  Scan                                  verifyFile                        VirusScan
  ScanCore   scancore                                                     ScanCoreChunkSize, ScanCoreMemoryLimit,
                                                                          ScanCoreDebug & ScanCoreVerbose
  Stream     ffmpeg                                                       StreamInspectionLayers,
                                                                          StreamInspectionFilesPerLayer,
                                                                          DefaultStreamInspectionForfeitAction,
                                                                          SupportedConversionTypes, $StreamArray,
                                                                          $StreamBaseURL, $MediaOutputArray &
                                                                          $VideoOutputArray
  Subtitle   ffmpeg
  Trace      imagemagick potrace        coverResolvedImageMagickPolicy
  Video      ffmpeg
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--What Still Reads As HRConvert2's--

Nothing a new application copies but the pipelines it adopts. Three things it will notice.

THE ENGINE'S HALF OF config.php IS WRITTEN IN HRCONVERT2'S WORDS WHERE A SETTING WAS FIRST WRITTEN FOR IT.
The stream settings, the default virus scanner & the per conversion limits, whose default names
HRConvert2's conversion families. An application gives its own value in $EngineSettingDefaults, a setting
written across several lines included, & the prose is shared.

THE CHECKERS CARRY HRCONVERT2'S NAME. They are hrconvert2-check.py, hrconvert2-check.sh,
hrconvert2-doccheck.py & hrconvert2-messages-cli.php, & they check whichever application the contract
describes. See --The Checkers--.

THE PIPELINES ARE HRCONVERT2'S. Each file's header names HRConvert2, & each guard dies with
HRConvert2-34000, or HRConvert2-2 in the Files pipeline, when a file is loaded directly. Their code names
no application, & an error one raises carries the adopting application's name, as every error does. An
application keeps the headers, & may give the guards its own name with the same numbers.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--The Checkers--

Each is run from the application root, & each says what it cannot see above the function that checks.

  python3 -I Documentation/Build/hrconvert2-check.py     The checks of the code. Authoritative.
  bash Documentation/Build/hrconvert2-check.sh           The second opinion, written in shell & awk.
  python3 -I Documentation/Build/hrconvert2-doccheck.py  The documents, in the house layout.
  php Documentation/Build/hrconvert2-messages-cli.php    Each warning & error, held to its line in the catalogue.

Each reads the entry point & the application's model from the contract, $EngineEntryPoint &
$EngineConfigModelProvider, so a new application runs them unchanged.
--no-scancore leaves out a bundled ScanCore, which a new application has only where it adopts the
ScanCore pipeline.
Documentation/ABOUT_QUALITY_CONTROL.txt says what each check is for & which fault it was written after.
The Engine's tests are in Documentation/Build/Tests, & its README.txt says how to run them.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--Upgrading The Engine Later--

The Engine is a drop in replacement for itself. Resources/Kernel & Resources/Engine are replaced whole,
& Resources/Contract & the application's half of config.php are the application's & stay. The pins are
raised to what the new files declare. A setting a newer Engine adds arrives in its half of the template,
so $RequiredConfigVersion is raised & php <entry point> --config --repair adds it to every config.php,
keeping every value an administrator set. A dependency a newer Engine needs arrives in its half of the
manifest, which it pins itself. An adopted pipeline is upgraded the same way, its folder replaced whole &
its pin raised to the $PipelineVersion the new folder declares.
----------------------------------------------------------------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------------------------------------------------------------
--For The Engine's Maintainer--

WHAT THIS KIT CHANGES IN zelon88/HRProprietary AT d2cf436, & WHERE EACH CHANGE IS RECORDED.
d2cf436 is the v4.2.4 kit with v4.2.6's pipeline library beside it. HRConvert2's v4.3.0 kit, unpacked
over it, added 12 files, changed 64 & removed none. v4.3.1 then moved ScanCore/ & Pipelines/ into
Resources/. Unpacking a kit cannot move a folder, so both are moved before this kit is unpacked:

  git mv ScanCore Resources/ScanCore
  git mv Pipelines Resources/Pipelines

Documentation/ENGINE_CHANGELOG.txt records every change v4.3.1 made, HRProtect's merge among them.
An application adopts v4.3.1 by taking Resources/Kernel & Resources/Engine whole & pinning what they
report. One that runs the scanners maps their five settings & pins them at v4.3.1, as the Example's
contract does. Every application pins the Event Core at v4.3.1 & gives EventLoc the root-only role,
as the Example does. The Engine's half of the template gained --Record Events--, so
$RequiredConfigVersion is raised & php <entry point> --config --repair adds it to config.php.
HRProtect, whose Event Core it was, removes its own copy of the core & of claimPrivateFolder(),
eventCoreStanding(), loadEventCore() & noteEvent(), & --Record Events-- from its half of the
template, because each is the Engine's now. A function defined twice stops PHP, & a setting in both
halves is one the checkers report. The rest of what follows is HRConvert2's.

  Resources/Engine/              engine.php, config-template.php, the Setup & Dependency Cores, & the
                                 new Sandbox/. ENGINE_RECONCILIATION_HRCONVERT2.txt records each, with
                                 why it changed & how another copy takes it.
  Resources/Pipelines/           Thirteen pipelines & the shared LibreOffice module, & two new shared
                                 modules. Archive, Drawing, Ebook & SVG are v4.2.8's, Trace v4.2.7's,
                                 & Audio, Document, Identify, Image, OCR, Stream, Subtitle & Video
                                 v4.3.0's. Each change is HRConvert2's, recorded in its CHANGELOG.txt.
  Resources/ScanCore/            Unchanged.
  Example/HRConvert2/            HRConvert2 v4.3.0's, & the five build scripts new to the kit.
  Documentation/                 Eleven documents changed, & the reconciliation file is new.

The reconciliation file lists the documents v4.2.5 & v4.2.7 changed, but for two of v4.2.5's. The
rest are below. Three describe the Engine in part, & every other change is HRConvert2's.

  v4.2.5  ENGINE_MIGRATION_STATUS.txt          Engine. A Fallback that fetches a release binary, & a
                                               program that cannot say its version. HRConvert2. Its
                                               count of settings.
          ABOUT_DATA_DIRECTORY_PROTECTION.txt  HRConvert2. xml became a conversion format.
  v4.2.6  ABOUT_DATA_DIRECTORY_PROTECTION.txt  HRConvert2. The links in a graph the Graph pipeline draws.
          ABOUT_PIPELINE_COMPONENTS.txt        HRConvert2. Where the Graph family sits.
          ERROR_DESCRIPTIONS.txt               HRConvert2. The Graph pipeline's block & warnings.
          DEVELOPMENT_NOTES.txt                HRConvert2. The Graph pipeline & the language packs.
  v4.2.8  ABOUT_PIPELINE_COMPONENTS.txt        HRConvert2. A request names its family, & what the shared
                                               LibreOffice module returns.
          ABOUT_WORKFLOWS.txt                  HRConvert2. A workflow's step names no family.
          CREATING_CONVERSION_PIPELINES.txt    HRConvert2. Step 9f, a menu names its family.
          ERROR_DESCRIPTIONS.txt               HRConvert2. Choosing a family, a refusal asked once &
                                               ImageMagick told the format it writes.
          DEVELOPMENT_NOTES.txt                HRConvert2. Six notes on formats & families.
  v4.3.0  ERROR_DESCRIPTIONS.txt               Engine. The warning for an identity file that could not
                                               be read. HRConvert2. Its pipelines' errors.
          DEVELOPMENT_NOTES.txt                Engine. A TOOL SEES THE ENGINE'S OWN ACCOUNT & NONE OF THE
                                               HOST'S IDENTITY. HRConvert2. Eleven other notes.
          ABOUT_NETWORK_ISOLATION.txt          HRConvert2. A stream segment a user uploads.
          ABOUT_PIPELINE_COMPONENTS.txt        HRConvert2. The fourth & fifth shared modules.
----------------------------------------------------------------------------------------------------------------------------------------------------------------
