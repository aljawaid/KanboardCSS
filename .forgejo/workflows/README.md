# GitHub-only workflows

This directory intentionally contains no native PP Git workflow files.

The workflows in `.github/workflows` are executed by GitHub Actions only. PP Git checks `.forgejo/workflows` before `.github/workflows`, so this marker prevents PP Git Actions from starting those GitHub workflows.

To enable native PP Git Actions later, add reviewed `.yml` or `.yaml` workflows to this directory and update this notice.