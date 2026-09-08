# Resources/Engine/Contract

**This folder is yours.** The Engine reads it and never writes it. When you take a newer
Engine, this is what you keep.

| File | What it says |
|---|---|
| `app-engine-config.php` | Which functions your application provides, and anything you need to differ from an Engine default. Loaded after `engineConfig.php`, so it wins. |
| `depends.php` | What your installation needs and how to get it. |
| `config-template.php` | A real `config.php` at default values. What your configuration looks like. |

## The template is the configuration

`config-template.php` is not a description of your configuration. It **is** one, at
defaults, with every section and every line of prose. The Engine reads it with the same
parser it reads a live configuration with.

A missing `config.php` is written from it. A repair adds whatever it holds that a live
configuration lacks. **An operator's value is never replaced by a default.**

Adding a setting means editing the template. That is the point of it being a real file
rather than a schema — the two cannot drift, because there is only one.

## Set only what differs

In `app-engine-config.php`, a setting repeated at the value the Engine already uses will
silently stop tracking that default when it changes for a good reason. Override what you
need and leave the rest alone.
