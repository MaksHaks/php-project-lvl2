### Hexlet tests and linter status:
[![Actions Status](https://github.com/MaksHaks/php-project-lvl2/workflows/hexlet-check/badge.svg)](https://github.com/MaksHaks/php-project-lvl2/actions)
[![linter & Test Status](https://github.com/MaksHaks/php-project-lvl2/actions/workflows/github-actions.yml/badge.svg)](https://github.com/MaksHaks/php-project-lvl2/actions)
<a href="https://codeclimate.com/github/MaksHaks/php-project-lvl2/maintainability"><img src="https://api.codeclimate.com/v1/badges/6cdcdc1e15d54d5e0447/maintainability" /></a>
<a href="https://codeclimate.com/github/MaksHaks/php-project-lvl2/test_coverage"><img src="https://api.codeclimate.com/v1/badges/6cdcdc1e15d54d5e0447/test_coverage" /></a>


## Description

The Difference Calculator is a console solution for finding differences between two files using PHP. Support for JSON, YML and YAML formats is provided. The solution supports various formats for outputting differences (Stylish, Plain and Json). The operation logic is based on recursive file comparison and takes into account the types and structure of the compared data.

## Setup

```sh
git clone https://github.com/MaksHaks/php-project-lvl2.git
make install
```

## Calculate Differences

Calculate difference between file1 and file2:
```sh
./bin/gendiff --format <format> <file1> <file2> 
```

For more information
```sh
./bin/gendiff -h
```

[![asciicast](https://asciinema.org/a/rNgJWOuMRq3JpJlb8SGQuSSua.svg)](https://asciinema.org/a/rNgJWOuMRq3JpJlb8SGQuSSua)
[![asciicast](https://asciinema.org/a/N53eakZkGFGtSdwux4F1BG6iS.svg)](https://asciinema.org/a/N53eakZkGFGtSdwux4F1BG6iS)
