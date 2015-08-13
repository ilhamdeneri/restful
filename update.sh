#!/usr/bin/env bash

# Get Repository
git pull origin master

# Update Database
app/console doctrine:schema:update --force

# Remove Cache
rm -rf app/cache/prod/*
rm -rf app/cache/dev/*
rm -rf app/logs/*

# Clear Doctrine Cache
app/console doctrine:cache:clear-query
app/console doctrine:cache:clear-result

# Assets Install
app/console assets:install web

# Assetic Dump
app/console assetic:dump