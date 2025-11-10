#!/bin/sh
npm install &&
composer install &&
npm run build &&
composer run dev
