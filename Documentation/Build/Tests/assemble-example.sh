#!/bin/bash
# The HRProprietary Engine's tests. Assembles the kit's Example into an application the suites & the checkers can run in, from v4.3.1.
#
#   bash Documentation/Build/Tests/assemble-example.sh /path/to/a/new/folder
#
# Run it from the root of the kit. The kit is not an application: its Engine, its pipelines & the Example's entry point & contract
# sit in separate folders, & a suite runs from the root of an application. This copies each where an application keeps it.
#
#   Example/HRConvert2/convertCore.php                  The root of the new folder.
#   Example/HRConvert2/Resources/versionInfo.php        Resources.
#   Example/HRConvert2/Resources/Contract               Resources/Contract.
#   Resources/Kernel, Engine, Pipelines & ScanCore       Resources, with Resources/index.html.
#   Documentation                                        Documentation, & the Example's own build scripts in Documentation/Build.
#   LICENSE & README.md                                  The root of the new folder.
#
# The new folder must not exist, so nothing that was there is ever written over. This script makes it & copies into it.
# It removes nothing. It holds no rm, rmdir, unlink or mv.

set -u

if [ "$#" -ne 1 ]; then
  echo "Usage: bash Documentation/Build/Tests/assemble-example.sh /path/to/a/new/folder" >&2
  exit 64
fi

target="$1"
case "$target" in
  /*) ;;
  *) echo "assemble-example.sh: name the new folder from the filesystem root, & nothing was copied." >&2; exit 64 ;;
esac

if [ ! -f Example/HRConvert2/convertCore.php ] || [ ! -f Resources/Kernel/kernel.php ] || [ ! -f Resources/Engine/engine.php ]; then
  echo "assemble-example.sh: run this from the root of the kit, which holds Example/ & Resources/, & nothing was copied." >&2
  exit 64
fi

if [ -e "$target" ] || [ -L "$target" ]; then
  echo "assemble-example.sh: $target already exists, & nothing was copied. Name a folder that does not exist yet." >&2
  exit 73
fi

mkdir -p "$target/Resources" \
  && cp -a Example/HRConvert2/convertCore.php "$target/" \
  && cp -a Example/HRConvert2/Resources/versionInfo.php Example/HRConvert2/Resources/Contract "$target/Resources/" \
  && cp -a Resources/Kernel Resources/Engine Resources/Pipelines Resources/ScanCore Resources/index.html "$target/Resources/" \
  && cp -a Documentation "$target/" \
  && cp -a Example/HRConvert2/Documentation/Build/. "$target/Documentation/Build/" \
  && cp -a LICENSE README.md "$target/" \
  || { echo "assemble-example.sh: a copy failed, so $target holds part of the Example. Name another folder." >&2; exit 74; }

echo "The Example is assembled at $target. Run the suites & the checkers from there."
