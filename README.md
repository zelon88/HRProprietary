# HRProprietary Engine

The part of a self-hosted application that has nothing to do with what the application
actually does.

Sandboxing. Resource budgets. Dependency management. Configuration that repairs itself.
Network egress control. Logging. Long-running managers that survive a request ending.

You write the part that makes your application yours. The Engine does the rest.

---

## What you get

**Every command runs sandboxed.** Bubblewrap, with per-tool profiles supplied by your
application as data. No network, no devices beyond the minimum, a tmpfs for anything
writable. The Engine builds whatever profile it is handed and holds no knowledge of any
particular tool.

**Dependencies are managed, not assumed.** One manifest describes what your installation
needs. `--setup` probes what is present, reports what is missing and installs what you
allow. It understands version *windows* — take every 3.14 patch, refuse the whole 3.15
line — and it understands architectures, so an x86-only tool reports `unsupported` on a
Raspberry Pi instead of failing with an unreadable error.

**A configuration that repairs itself.** Delete `config.php` entirely and
`--config --repair` writes a working one from your template. Miss a single setting and it
offers that setting back with the right default. An operator's own values are never
replaced.

**Resource budgets that actually hold.** cgroup-backed limits on what a workload may
consume, enforced by a manager that outlives the request that started it. Where cgroup
delegation is unavailable — which is most NAS hardware — it says so plainly rather than
pretending.

**Network egress you control.** Requests are checked against public routability before they
leave. Private ranges are refused unless you list them. Three ranges are refused whatever
you configure, and that rule lives in code rather than in documentation.

**It runs on what you already have.** x86_64, ARM64, ARM. A Raspberry Pi, a NAS, a VPS, a
rack. No container required, no daemon to register, no service to subscribe to.

---

## How an application uses it

Your application names up to six functions. The Engine calls what it is given and knows
nothing else about you.

```php
$EngineOperatorPrompt      = 'askOperator';
$EngineConfigModelProvider = 'applicationConfigModel';
$EngineRepairProvider      = 'fixManagedPermissions';
```

That is the whole interface. Every one is optional — an Engine given none of them runs and
does less, which is a floor rather than a failure. Add them as you need them.

`app.php` in this repository is the smallest thing that satisfies the contract and starts.
Run `php app.php` and it will load the Engine, report what it found on your host, and exit.

---

## Upgrading

```
Resources/Engine/
  engine.php        engineConfig.php        ← copy these
  Cores/            Managers/               ← and these
  Contract/                                 ← leave this alone
```

Three files in `Contract/` are yours: what your application needs installed, what its
configuration looks like, and which functions it provides. Everything else is the Engine.

That is why the Engine ships *inside* an application rather than beside it. You carry the
Engine you tested against, and a newer one arrives when you choose it — not when a package
manager decides. Two applications built on the same Engine trade improvements by copying a
directory.

---

## Design

**No cookies. No database. No third-party calls. No analytics.** Not as a feature list —
as an architectural constraint that has held since the first release, and the reason a
self-hosted installation stays genuinely self-hosted.

**Every component is version-pinned and verified before it loads.** A component whose
version cannot be read is refused rather than trusted, because an unknown build cannot be
cleared.

**A subsystem that can fall back does so before it errors.** Try the requested thing, warn,
try the default, warn again, and only then fail. A user who cannot read the page cannot
report the problem.

**Every value is destroyed when the code that needed it finishes.** Not left for the
garbage collector. See `Documentation/ABOUT_DEFENSIVE_MEMORY_MANAGEMENT.md` for why.

---

## Requirements

PHP 8.0 or newer. Bubblewrap for sandboxing. systemd if you want resource budgets. Both
degrade to something honest when absent rather than failing at the point of use.

---

## Status

Extracted from HRConvert2, where it has been in production use. HRConvert2 remains its
reference implementation, and a second application is being built on it now.

The interface is stable enough to build against and young enough to be worth arguing with.
If something in it is wrong for your application, that is worth hearing — the contract is
six function names, which is a small enough surface to change well.

## License

GNU GPLv3.

<3 Open-Source
