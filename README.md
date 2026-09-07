# HRProprietary Engine

A runtime for PHP applications that hand untrusted files to third-party tools.

It came out of [HRConvert2](https://github.com/zelon88/HRConvert2), a file conversion server
that accepts uploads from anyone and feeds them to FFmpeg, ImageMagick, LibreOffice,
OpenSCAD and a dozen others. Those tools are the attack surface. This is what stands
around them.

---

## What it does

**Sandboxes every command.** `sandboxCommand()` wraps a dependency in a Bubblewrap
namespace with no network, a minimal device set, a tmpfs for anything writable, and
read-only access to the two directories it was handed. A command that cannot be sandboxed
must carry a comment saying why.

**Never lets a tool resolve a name.** The application resolves, inspects the address, and
hands the tool the address rather than the name. A sandbox with a network and no resolver
cannot look anything up, which is the enforcement rather than the policy. See
[ABOUT_NETWORK_ISOLATION.txt](Documentation/ABOUT_NETWORK_ISOLATION.txt).

**Refuses addresses that are not publicly routable.** Private ranges, carrier NAT,
documentation and benchmarking ranges, multicast, link-local, and IPv4 wrapped in IPv6 —
`::ffff:127.0.0.1` is loopback written in a form the IPv4 checks never see.

**Runs work under managers with a budget.** Four manager roles behind unix sockets track
workers, hand out and reclaim operation budget, and terminate what overruns. A fifth, the
Environment Manager, runs as root on a timer, opens no socket, and watches the host.

**Shreds values rather than releasing them.** `purgeSensitiveMemory()` overwrites a string's
bytes before letting go, and the convention is that every local is destroyed before its
function returns.

---

## What it is not

It is not a framework. It does not route, template, authenticate or store. It has no
opinion about what your application does with a file — only about what happens to the
process that touches it.

It does not sandbox your application. It sandboxes the things your application shells out
to, which is a different and more tractable problem.

---

## Getting started

```
git clone <this repo> myapp
cd myapp
php app.php
```

`app.php` is a placeholder. It is the smallest thing that satisfies the contract and
starts — it loads the Engine, reports what it found, and exits. Replace it with your
application. HRConvert2 puts `convertCore.php` in that spot.

`Resources/config.php` holds the settings the Engine reads. Change the data locations
first; the defaults point at `/DATA/ExampleApp`.

---

## The contract

The Engine calls twelve functions it does not define, because how an application logs,
sanitizes or finds a binary is the application's business. All twelve are implemented in
`app.php` well enough to start and not well enough to ship.

| Function | Calls | What it owes the Engine |
|---|---|---|
| `purgeSensitiveMemory()` | 81 | Destroy values by reference. Never pass it a return value. |
| `warningEntry()` | 65 | Always written, carries no number. |
| `logEntry()` | 52 | Normal activity, suppressed when quiet. |
| `errorEntry()` | 14 | Documented number, sometimes fatal. |
| `sanitize()` | 13 | Remove what a value must never contain. |
| `locateDependency()` | 4 | Find an executable. Kernel, not Engine. |
| `readComponentVersion()` | 1 | Read a version without executing the file. |
| `getRealPath()` `isDir()` `verifyFile()` `virusScan()` | 1 each | Filesystem answers on your terms. |
| `fixManagedPermissions()` | 1 | Repair the host. Only the Environment Manager calls it. |

Two more are handed over as **data** rather than called by name:

- `$EngineSandboxProfiles` — what each sandbox profile permits, and **why**. The Engine
  holds no knowledge of any profile.
- `$EngineEnvironmentProvider` — the name of a function that reports on your environment.
  The Engine checks Bubblewrap and calls whatever you named for the rest. An application
  with no AppArmor policy is never asked about one.

See [ABOUT_ENGINE_CONTRACT.txt](Documentation/ABOUT_ENGINE_CONTRACT.txt).

---

## Layout

```
app.php                            your application goes here
Resources/
  config.php                       settings the Engine reads
  Engine/
    engine.php                     the Engine
    engineConfig.php               Engine tuning, read before the Engine
    Managers/
      coreManager.php              the listener
      resourceManager.php          budget, scaling, cleanup
      workerManager.php            worker lifecycle
      requestManager.php           request handling
      environmentManager.php       root watchman, no socket, timer only
Documentation/
```

The structure is deliberate. It mirrors where these files sit inside an application, so a
clone drops into place rather than needing to be rearranged.

---

## Reading order

1. [ABOUT_ENGINE_CONTRACT.txt](Documentation/ABOUT_ENGINE_CONTRACT.txt) — what the Engine
   requires and what it refuses to know about you.
2. [ABOUT_NETWORK_ISOLATION.txt](Documentation/ABOUT_NETWORK_ISOLATION.txt) — how a remote
   address is inspected, pinned and reached, **and what still gets through**.
3. [ABOUT_ENVIRONMENT_MANAGER.txt](Documentation/ABOUT_ENVIRONMENT_MANAGER.txt) — the root
   process, why it has no socket, and why it watches before it repairs.
4. [ABOUT_LOGGING.txt](Documentation/ABOUT_LOGGING.txt) — the three tiers and which to use.
5. [CODING_CONVENTIONS.txt](Documentation/CODING_CONVENTIONS.txt) — the memory rules, the
   sandbox rule, and why comments are written the way they are.

---

## Known limits

Stated here rather than discovered later.

**A redirect to a literal IP address is not stopped.** Pinning defeats a name that resolves
differently the second time, but an address needs no lookup. Bubblewrap cannot filter it —
an unprivileged user namespace cannot install a packet filter, and seccomp sees a
`connect()` argument as a number rather than the memory it points at. The fix is an egress
filter inside the namespace; `Documentation/ABOUT_NETWORK_ISOLATION.txt` describes what was
proved and what was not.

**The Environment Manager repairs once a day, not on demand.** It looks hourly. If
something is undoing its repair, you want an operator rather than a loop.

**It has been exercised by one application.** HRConvert2 is the only thing that has run on
it. The contract is honest about what the Engine requires, but no second application has
tested that honesty.

---

## License

GNU GPLv3. See [LICENSE](LICENSE).
